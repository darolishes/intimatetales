<?php

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

class IntimateTales_Roleplay_Interface {

    private $current_story_id;
    private $current_scene_id;
    private $user_choices;
    private $mainClassInstance;

    public function __construct() {
        $this->current_story_id = null;
        $this->current_scene_id = null;
        $this->user_choices = array();
        $this->mainClassInstance = new IntimateTales_Main_Class();
    }

    /**
     * Render the current scene of the story.
     */
    public function render_scene() {
        $scene_content = $this->get_scene_content($this->current_scene_id);
        $user_choices = $this->get_user_choices_for_scene($this->current_scene_id);

        // Load the template with the content and choices
        $output = $this->mainClassInstance->load_template('roleplay-scene', array(
            'scene_content' => $scene_content,
            'user_choices' => $user_choices
        ));
        return $output;
    }

    /**
     * Retrieve scene content from the database or cache
     */
    private function get_scene_content($scene_id) {
        // Assuming scenes are stored as custom post types or meta
        $scene_content = get_post_meta($scene_id, 'scene_content', true);
        
        if (!$scene_content) {
            return false;
        }
        
        return $scene_content;
    }
    
    /**
     * Retrieve user choices available for a specific scene.
     */
    private function get_user_choices_for_scene($scene_id) {
        // Logic to fetch choices for a scene. 
        // This is a placeholder and should be implemented based on your storage mechanism.
        $choices = array();
        return $choices;
    }

    /**
     * Update the current scene based on user's choice
     */
    public function update_scene_based_on_choice($choice_id) {
        // Update logic based on choice
        $next_scene_id = get_post_meta($choice_id, 'next_scene_id', true);
        if ($next_scene_id) {
            $this->current_scene_id = $next_scene_id;
        }
    }

    /**
     * Store the user's choices for analytics or further processing
     */
    public function store_user_choice($user_id, $choice_id) {
        array_push($this->user_choices, $choice_id);
        
        // Store in usermeta for persistence
        update_user_meta($user_id, 'intimate_user_choices', $this->user_choices);
    }
}
