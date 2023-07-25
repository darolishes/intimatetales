<?php
/**
 * Plugin Name: Intimate Tales
 * Plugin URI: https://intimate-tales.de/
 * Description: A WordPress plugin for managing intimate roleplay stories.
 * Version: 1.0.0
 * Author: Your Name
 * Author URI: https://intimate-tales.de/
 * Text Domain: intimate-tales
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

namespace IntimateTales;

defined('ABSPATH') || exit;

define('INTIMATE_TALES_VERSION', '1.0.0');
define('INTIMATE_TALES_PLUGIN_DIR', trailingslashit(plugin_dir_path(__FILE__)));
define('INTIMATE_TALES_PLUGIN_URL', plugin_dir_url(__FILE__));

spl_autoload_register(function ($classname) {
    $namespace = 'IntimateTales\\';
    if (strpos($classname, $namespace) === 0) {
        $class = str_replace($namespace, '', $classname);
        $file = INTIMATE_TALES_PLUGIN_DIR . 'includes/' . str_replace('\\', '/', $class) . '.php';

        if (file_exists($file)) {
            require_once $file;
        }
    }
});

add_action('plugins_loaded', function () {
    Plugin::get_instance();
});
