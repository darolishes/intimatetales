<?php

namespace IntimateTales;

class Settings
{
    private $settings = [];

    // Methode zum Abrufen einer spezifischen Einstellung
    public function getOption($option_name)
    {
        return isset($this->settings[$option_name]) ? $this->settings[$option_name] : false;
    }

    // Methode zum Laden aller Einstellungen
    public function getSettings()
    {
        global $it_settings;

        if (function_exists('get_field')) {
            // Lade Einstellungen aus der ACF-Optionenseite
            $it_settings = get_field('options', 'option');
        }
    }

    // Methode zum Speichern aller Einstellungen
    public function saveSettings()
    {
        global $it_settings;

        if (function_exists('update_field')) {
            // Speichere $it_settings in der ACF-Optionenseite
            update_field('options', $it_settings, 'option');
        }
    }

    // Methode zum Abrufen einer spezifischen Einstellung
    public function getSetting($key)
    {
        global $it_settings;
        return $it_settings[$key] ?? null;
    }

    // Methode zum Festlegen einer spezifischen Einstellung
    public function setSetting($key, $value)
    {
        global $it_settings;
        $it_settings[$key] = $value;

        if (function_exists('update_field')) {
            // Aktualisiere die Einstellung in der ACF-Optionenseite
            update_field($key, $value, 'option');
        }
    }
}
