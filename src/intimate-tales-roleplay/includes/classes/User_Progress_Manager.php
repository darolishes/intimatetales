<?php

namespace IntimateTales;

class User_Progress_Manager {

    // Holt den aktuellen Fortschritt des Benutzers in der Geschichte.
    public function get_user_progress($user_id) {
        $progress = get_user_meta($user_id, 'story_progress', true);
        if (!$progress) {
            $progress = [
                'stories_completed' => [],
                'current_story' => 0,
                'current_branch' => 0
            ];
        }
        return $progress;
    }

    // Aktualisiert den Fortschritt des Benutzers in der Geschichte.
    public function update_user_progress($user_id, $story_id, $branch_id = null) {
        $progress = $this->get_user_progress($user_id);

        $progress['stories_completed'][] = $story_id;
        $progress['current_story'] = $story_id;

        if ($branch_id) {
            $progress['current_branch'] = $branch_id;
        }

        update_user_meta($user_id, 'story_progress', $progress);
    }

    // Setzt den Fortschritt des Benutzers zurück.
    public function reset_user_progress($user_id) {
        delete_user_meta($user_id, 'story_progress');
    }

    // Holt den aktuellen Pfad des Benutzers (basierend auf den Geschichten und Verzweigungen, die er ausgewählt hat).
    public function get_user_path($user_id) {
        $progress = $this->get_user_progress($user_id);
        return [
            'stories' => $progress['stories_completed'],
            'current_story' => $progress['current_story'],
            'current_branch' => $progress['current_branch']
        ];
    }
}
