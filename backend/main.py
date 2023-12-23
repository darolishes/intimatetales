import os
import sys
import torch
import string
import random
import logging
import platform
from diffusers import AutoPipelineForText2Image
from flask import Flask, request, jsonify, send_from_directory
from flask_cors import CORS
from litellm import LiteLLMClient  # Import LiteLLM

# Konfiguration
SD_MODEL = sys.argv[1] if len(sys.argv) > 1 else "default-sd-model"
LITELLM_MODEL = os.getenv("LITELLM_MODEL", "default-litellm-model")
OPENAI_API_KEY = os.getenv("OPENAI_API_KEY", "")

# Initialisierung
app = Flask(__name__)
CORS(app)
log = logging.getLogger(__name__)
pipe = None
is_generating_image = False

# LiteLLM-Client Setup
litellm_client = LiteLLMClient(api_key=OPENAI_API_KEY)

# Bildgenerierungspipeline initialisieren
def init_pipeline():
    global pipe
    try:
        system = platform.system()
        if system == "Darwin":
            pipe = AutoPipelineForText2Image.from_pretrained(SD_MODEL, local_files_only=True).to("mps")
        elif torch.cuda.is_available():
            pipe = AutoPipelineForText2Image.from_pretrained(SD_MODEL, torch_dtype=torch.float16, variant="fp16", local_files_only=True).to("cuda")
        else:
            pipe = AutoPipelineForText2Image.from_pretrained(SD_MODEL, local_files_only=True).to("cpu")
    except Exception as e:
        log.error(f"An error occurred while initializing the pipeline: {e}")
        sys.exit(1)

init_pipeline()

@app.route("/")
def index():
    return "Hello, My Virtual Adventure!"

@app.route("/images/<path:filename>")
def get_image(filename):
    return send_from_directory("images", filename)

@app.route("/generate_image", methods=["POST"])
def generate_image():
    global is_generating_image
    if is_generating_image:
        return jsonify({"error": "Already generating image"}), 429

    is_generating_image = True
    data = request.get_json()
    keywords = data.get("keywords", "")
    width = data.get("width", 512)
    height = data.get("height", 512)
    steps = data.get("steps", 50)
    guidance_scale = data.get("guidance_scale", 7.5)  # Beispielwert für den Guidance-Scale-Parameter

    # Zusätzliche Einstellungen für die Bildgenerierung
    negative_prompts = data.get("negative_prompts", [])  # Eine Liste negativer Prompts
    if not isinstance(negative_prompts, list):
        negative_prompts = [negative_prompts]

    try:
        generated_image = pipe(
            prompt=keywords,
            negative_prompt=negative_prompts,
            height=height,
            width=width,
            guidance_scale=guidance_scale,  # Guidance-Scale verwenden
            num_inference_steps=steps
        )
        image_name = generate_random_name(10) + ".png"
        generated_image.images[0].save(f"images/{image_name}")
    except Exception as e:
        log.error(f"Error during image generation: {e}")
        is_generating_image = False
        return jsonify({"error": "Image generation failed"}), 500

    is_generating_image = False
    return jsonify({"file_name": image_name})

@app.route("/process_text", methods=["POST"])
def process_text():
    data = request.get_json()
    text = data.get("text", "")

    try:
        # LiteLLM-Verarbeitung hier
        response = litellm_client.generate(text, model_name=LITELLM_MODEL)
        return jsonify({"response": response})
    except Exception as e:
        log.error(f"Error during LiteLLM processing: {e}")
        return jsonify({"error": "LiteLLM processing failed"}), 500

def generate_random_name(length):
    return ''.join(random.choices(string.ascii_lowercase, k=length))

if __name__ == "__main__":
    app.run(debug=True, host='0.0.0.0', port=8080)