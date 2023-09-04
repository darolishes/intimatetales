<?php

namespace IntimateTales;

class Character_Attributes_Manager {

    // Fügt ein neues Charakterattribut hinzu.
    public function add_attribute($name, $description) {
        // Hier würden Sie das Attribut in der Datenbank speichern.
        // Zum Beispiel als benutzerdefinierten Post-Typ oder in einer speziellen Tabelle.
        return wp_insert_post([
            'post_type' => 'character_attribute',
            'post_title' => $name,
            'post_content' => $description,
            'post_status' => 'publish'
        ]);
    }

    // Holt ein Charakterattribut anhand seiner ID.
    public function get_attribute($attribute_id) {
        return get_post($attribute_id);
    }

    // Aktualisiert ein Charakterattribut.
    public function update_attribute($attribute_id, $name, $description) {
        return wp_update_post([
            'ID' => $attribute_id,
            'post_title' => $name,
            'post_content' => $description
        ]);
    }

    // Löscht ein Charakterattribut.
    public function delete_attribute($attribute_id) {
        return wp_delete_post($attribute_id, true);
    }

    // Holt alle Charakterattribute.
    public function get_all_attributes() {
        $args = [
            'post_type' => 'character_attribute',
            'posts_per_page' => -1
        ];
        return get_posts($args);
    }
}
