#!/bin/bash

# Lädt Umgebungsvariablen aus der .env-Datei
if [ -f .env ]; then
  export $(cat .env | xargs)
else 
  echo ".env file not found"
  exit 1
fi

# LiteLLM-Modell und Stable Diffusion-Modell aus Umgebungsvariablen
LITELLM_MODEL=$LITELLM_MODEL
SD_MODEL=$SD_MODEL

cleanup() {
  echo "Stopping the app..."
  kill -- -$$
  pkill -f "node"
  pkill -f "python"
  exit 0
}

trap cleanup INT

# Überprüft und installiert Git, falls noch nicht installiert
if ! command -v git &> /dev/null; then
    echo "Git is not installed, please install it first."
    exit 1
fi

# Aktualisiert Submodule
git submodule update --init --recursive --remote

# Überprüft und installiert Miniconda, falls noch nicht installiert
# [Miniconda-Installationsbefehle hier einfügen]

# Erstellt und aktiviert eine neue Umgebung mit Python 3.11
conda create -n ImpAI python=3.11 -y
conda activate ImpAI

# Installiert LiteLLM
pip install litellm

# Startet LiteLLM Proxy-Server
litellm --model $LITELLM_MODEL &

# Startet Backend (für Bildgenerierung)
cd backend
python3.11 -m pip install -r requirements.txt
python3.11 main.py $SD_MODEL &

# Wechselt zum Frontend-Verzeichnis
cd ../frontend

# Installiert und startet Frontend
npm install
npm start &

# Wartet auf Beendigung der Hintergrundprozesse
wait