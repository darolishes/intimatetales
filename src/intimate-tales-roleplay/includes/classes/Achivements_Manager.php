<?php

namespace IntimateTales;

class Achievements_Manager {

    // Fügt einem Benutzer einen Erfolg hinzu.
    public function add_achievement_to_user($user_id, $achievement_id) {
        $achievements = $this->get_user_achievements($user_id);
        if (!in_array($achievement_id, $achievements)) {
            $achievements[] = $achievement_id;
            update_user_meta($user_id, 'it_achievements', $achievements);
        }
    }

    // Holt alle Erfolge eines Benutzers.
    public function get_user_achievements($user_id) {
        return get_user_meta($user_id, 'it_achievements', true) ?? [];
    }

    // Überprüft, ob ein Benutzer einen bestimmten Erfolg hat.
    public function user_has_achievement($user_id, $achievement_id) {
        $achievements = $this->get_user_achievements($user_id);
        return in_array($achievement_id, $achievements);
    }
}
