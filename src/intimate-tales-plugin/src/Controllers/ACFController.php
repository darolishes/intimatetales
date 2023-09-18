<?php

namespace IntimateTales\Controllers;

class ACFController
{
    /**
     * Initialisiert die ACF-bezogenen Filter.
     */
    public function __construct()
    {
        add_filter('acf/settings/load_json', [$this, 'acf_load_json']);
        add_filter('acf/settings/save_json', [$this, 'acf_save_json']);
        add_filter('acf/json/save_paths', [$this, 'acf_save_paths'], 10, 2);
        add_filter('acf/json/save_file_name', [$this, 'acf_save_file_name'], 10, 3);
    }
}
