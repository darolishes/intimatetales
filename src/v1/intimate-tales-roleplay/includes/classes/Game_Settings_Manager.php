<?php

namespace IntimateTales;

class Game_Settings_Manager {

    // Setzt eine Spieleinstellung.
    public function set_setting($name, $value) {
        return update_option('it_game_setting_' . $name, $value);
    }

    // Holt eine Spieleinstellung.
    public function get_setting($name) {
        return get_option('it_game_setting_' . $name);
    }

    // Löscht eine Spieleinstellung.
    public function delete_setting($name) {
        return delete_option('it_game_setting_' . $name);
    }
}
