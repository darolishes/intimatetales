<?php

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

class IT_Roleplay
{

    private $user_id;
    private $partner_id = null;
    private $current_story;
    private $current_scene_id;
    private $user_choices = array();
    private $mode; // solo or pair

    public function __construct($user_id, $story, $mode = 'solo')
    {
        $this->user_id = $user_id;
        $this->current_story = $story;
        $this->mode = $mode;

        if ($this->mode === 'pair') {
            $this->partner_id = $this->get_partner_id($user_id);
        }
    }

    private function get_partner_id($user_id)
    {
        // Placeholder: Implement logic to fetch partner_id based on your database structure
        return null;
    }

    public function render_scene()
    {
        $scene_content = $this->get_scene_content($this->current_scene_id);
        $user_choices = $this->get_user_choices_for_scene($this->current_scene_id);

        $output = array(
            'scene_content' => $scene_content,
            'user_choices' => $user_choices
        );
        return $output;
    }

    private function get_scene_content($scene_id)
    {
        $scene_content = get_post_meta($scene_id, 'scene_content', true);
        return $scene_content ?: false;
    }

    private function get_user_choices_for_scene($scene_id)
    {
        // Placeholder: Implement logic to fetch choices for a scene from the database.
        return array();
    }

    public function update_scene_based_on_choice($choice_id)
    {
        $next_scene_id = get_post_meta($choice_id, 'next_scene_id', true);
        if ($next_scene_id) {
            $this->current_scene_id = $next_scene_id;
        }
    }

    public function store_user_choice($choice_id)
    {
        array_push($this->user_choices, $choice_id);
        update_user_meta($this->user_id, 'intimate_user_choices', $this->user_choices);
    }

    public function wait_for_partner_choice()
    {
        if ($this->mode !== 'pair' || !$this->partner_id) {
            return false;
        }

        // Placeholder: Implement logic to wait/check for the partner's choice.
        // This might involve periodic checks or websocket communications.

        return true; // return true when partner has made a choice.
    }

    public function get_progress_bar()
    {
        $total_scenes = count(get_post_meta($this->current_story, 'scenes', true));
        $progress = ($this->current_scene_id / $total_scenes) * 100;

        return $progress . '%';
    }

    public function switch_mode($new_mode)
    {
        if (in_array($new_mode, ['solo', 'pair'])) {
            $this->mode = $new_mode;
            return true;
        }
        return false;
    }
}
