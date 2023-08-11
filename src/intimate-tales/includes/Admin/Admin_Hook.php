<?php

namespace IntimateTales\Admin;

use IntimateTales\Helper\Acf_Json_Helper;

class Admin_Hook {

    public static function register() {
        add_filter('acf/json/save_paths', [Acf_Helper::class, 'filter_save_paths']);
    }
}
