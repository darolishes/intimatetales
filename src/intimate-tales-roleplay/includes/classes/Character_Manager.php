<?php

namespace IntimateTales;

class Character_Manager {

    /**
     * Holt die Charaktereigenschaften eines Benutzers.
     *
     * @param int $user_id Die ID des Benutzers.
     * @return array Eine Liste von Charaktermerkmalen des Benutzers.
     */
    public function get_character_traits($user_id) {
        $traits = get_user_meta($user_id, 'character_traits', true);
        return is_array($traits) ? $traits : [];
    }

    /**
     * Aktualisiert die Charaktereigenschaften eines Benutzers.
     *
     * @param int $user_id Die ID des Benutzers.
     * @param array $traits Die neuen Charaktermerkmale.
     * @return bool True bei Erfolg, false bei einem Fehler.
     */
    public function update_character_traits($user_id, $traits) {
        return update_user_meta($user_id, 'character_traits', $traits);
    }

    /**
     * Holt alle verfügbaren Charaktermerkmale aus der Datenbank.
     *
     * @return array Eine Liste von verfügbaren Charaktermerkmalen.
     */
    public function get_all_available_traits() {
        // Diese Methode könnte eine Datenbankabfrage verwenden, um alle Charaktermerkmale zu erhalten.
        // Zum Beispiel könnten Sie einen benutzerdefinierten Post-Typ oder eine Taxonomie verwenden, 
        // um Charaktermerkmale zu speichern.
        // Hier ist ein Platzhalter:
        return ['Haarfarbe: Schwarz', 'Augenfarbe: Blau', 'Stärke: Stark'];
    }
}
