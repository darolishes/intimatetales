<?php

namespace IntimateTales;

class Feedback_Manager {

    // Speichert das Feedback eines Benutzers.
    public function save_user_feedback($user_id, $feedback, $related_story_id = null) {
        $feedback_entry = [
            'user_id' => $user_id,
            'feedback' => sanitize_text_field($feedback),
            'timestamp' => current_time('mysql'),
            'related_story_id' => $related_story_id
        ];
        // Hier würden Sie das Feedback in der Datenbank speichern, z.B. als benutzerdefinierten Post-Typ oder in einer speziellen Feedback-Tabelle.
        return wp_insert_post([
            'post_type' => 'feedback',
            'post_content' => $feedback_entry['feedback'],
            'post_status' => 'publish',
            'meta_input' => [
                'user_id' => $feedback_entry['user_id'],
                'related_story_id' => $feedback_entry['related_story_id'],
                'timestamp' => $feedback_entry['timestamp']
            ]
        ]);
    }

    // Holt alle Feedback-Einträge.
    public function get_all_feedback() {
        $args = [
            'post_type' => 'feedback',
            'posts_per_page' => -1
        ];
        $feedback_posts = get_posts($args);
        $feedback_list = [];
        foreach ($feedback_posts as $post) {
            $feedback_list[] = [
                'feedback' => $post->post_content,
                'user_id' => get_post_meta($post->ID, 'user_id', true),
                'related_story_id' => get_post_meta($post->ID, 'related_story_id', true),
                'timestamp' => get_post_meta($post->ID, 'timestamp', true)
            ];
        }
        return $feedback_list;
    }

    // Holt das Feedback speziell für eine Geschichte.
    public function get_feedback_for_story($story_id) {
        $args = [
            'post_type' => 'feedback',
            'posts_per_page' => -1,
            'meta_key' => 'related_story_id',
            'meta_value' => $story_id
        ];
        $feedback_posts = get_posts($args);
        $feedback_list = [];
        foreach ($feedback_posts as $post) {
            $feedback_list[] = [
                'feedback' => $post->post_content,
                'user_id' => get_post_meta($post->ID, 'user_id', true),
                'timestamp' => get_post_meta($post->ID, 'timestamp', true)
            ];
        }
        return $feedback_list;
    }
}
