<?php

namespace IntimateTales;

class Story_Manager {

    /**
     * Holt eine Geschichte anhand ihrer ID.
     *
     * @param int $story_id Die ID der Geschichte.
     * @return WP_Post|null Die Geschichte als WP_Post-Objekt oder null, wenn sie nicht gefunden wurde.
     */
    public function get_story_by_id($story_id) {
        return get_post($story_id);
    }

    /**
     * Holt die nächste Geschichte basierend auf dem Fortschritt des Benutzers.
     *
     * @param int $user_id Die ID des Benutzers.
     * @return WP_Post|null Die nächste Geschichte oder null, wenn keine weitere Geschichte verfügbar ist.
     */
    public function get_next_story($user_id) {
        // Beispiellogik: Holt die letzte Geschichte, die der Benutzer gelesen hat, und gibt die nächste zurück.
        $last_read_story_id = get_user_meta($user_id, 'last_read_story', true);
        $next_story_id = $last_read_story_id + 1;
        return $this->get_story_by_id($next_story_id);
    }

    /**
     * Holt alle Verzweigungen für eine bestimmte Geschichte.
     *
     * @param int $story_id Die ID der Geschichte.
     * @return array Eine Liste von Verzweigungen.
     */
    public function get_branches_for_story($story_id) {
        // Beispiellogik: Holt benutzerdefinierte Felder (Verzweigungen) für eine Geschichte.
        $branches = get_post_meta($story_id, 'branches', true);
        return is_array($branches) ? $branches : [];
    }

    /**
     * Speichert den Fortschritt eines Benutzers in einer Geschichte.
     *
     * @param int $user_id Die ID des Benutzers.
     * @param int $story_id Die ID der Geschichte.
     * @return bool True bei Erfolg, false bei einem Fehler.
     */
    public function save_user_progress($user_id, $story_id) {
        return update_user_meta($user_id, 'last_read_story', $story_id);
    }
}
