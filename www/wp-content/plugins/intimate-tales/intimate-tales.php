<?php
/**
 * Plugin Name: Intimate Tales
 * Plugin URI: https://intimate-tales.de/
 * Description: A WordPress plugin for managing intimate roleplay stories.
 * Version: 1.0.0
 * Author: Dawid Rogaczewski
 * Author URI: https://intimate-tales.de/
 * Text Domain: intimate-tales
 */

namespace IntimateTales;

// Exit if accessed directly.
defined('ABSPATH') || exit;

define('INTIMATE_TALES_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('INTIMATE_TALES_PLUGIN_URL', plugin_dir_url(__FILE__));
define('INTIMATE_TALES_PLUGIN_VERSION', '1.0.0');

// Load Composer autoload if available.
if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
}

/**
 * Plugin class loader.
 */
spl_autoload_register(function ($class) {
    $namespace = 'IntimateTales\\';

    // Only autoload classes from this plugin.
    if (strpos($class, $namespace) === 0) {
        $relative_class = substr($class, strlen($namespace));
        $file = INTIMATE_TALES_PLUGIN_DIR . 'classes/' . str_replace('\\', '/', $relative_class) . '.php';

        if (file_exists($file)) {
            require_once $file;
        }
    }
});

/**
 * Initialize the plugin.
 */
function init(): Plugin
{
    return Plugin::init();
}

init();

