<?php

namespace IntimateTales;

class Cache
{
    private $cache = [];

    public function getCachedData($key)
    {
        // Überprüfe, ob die Daten im Cache vorhanden sind
        if (isset($this->cache[$key])) {
            return $this->cache[$key];
        } else {
            // Wenn die Daten nicht im Cache sind, hole und speichere sie
            $data = $this->fetchDataFromSource($key);
            $this->setCache($key, $data);
            return $data;
        }
    }

    private function fetchDataFromSource($key)
    {
        // Die get_field Funktion wird verwendet, um Daten aus ACF zu holen
        $data = get_field($key, 'option');

        // Wenn keine Daten gefunden wurden, können wir einen leeren String oder einen anderen Standardwert zurückgeben
        if (!$data) {
            $data = '';
        }

        return $data;
    }

    public function setCache($key, $data)
    {
        global $it_cache;
        $it_cache[$key] = $data;
    }

    public function deleteCache($key)
    {
        global $it_cache;
        if (isset($it_cache[$key])) {
            unset($it_cache[$key]);
        }
    }
}
