<?php
namespace IntimateTales;

/**
 * Plugin Name: IntimateTales
 * Plugin URI: https://www.intimatetales.com
 * Description: A WordPress plugin for the IntimateTales platform.
 * Version: 1.0.0
 * Author: Dawid Rogaczewski
 * Author URI: https://www.yourwebsite.com
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: intimate-tales
 * Domain Path: /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

define('INTIMATE_TALES_PLUGIN_FILE', __FILE__);
define('INTIMATE_TALES_PLUGIN_DIR', __DIR__ . DIRECTORY_SEPARATOR);


// Register autoloader for classes
spl_autoload_register(function ($class) {
    $prefix = 'IntimateTales\\';
    $base_dir = __DIR__ . '/classes/';

    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    if (file_exists($file)) {
        require_once $file;
    }
});

// Initialize the plugin if the class exists
if (class_exists('IntimateTales\Plugin')) {
    Plugin::getInstance(__FILE__);
}
