
/**
 * Plugin Name: Intimate Tales User
 * Description: A WordPress plugin to manage user-related functionalities for the IntimateTales platform.
 * Version: 1.0.0
 * Requires PHP: 8.0
 * Author: Dawid Rogaczewski
 * Author URI: https://www.intimate-tales.de
 * Text Domain: intimate-tales-user
 * Domain Path: /languages
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Define constants for the plugin
define('INTIMATE_TALES_USER_DIR_PATH', plugin_dir_path(__FILE__));
define('INTIMATE_TALES_USER_DIR_URL', plugin_dir_url(__FILE__));

// Use autoloader for class files
spl_autoload_register(function($class_name) {
    if (false !== strpos($class_name, 'IntimateTales')) {
        $classes_dir = realpath(plugin_dir_path(__FILE__)) . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR;
        $class_file = str_replace('_', DIRECTORY_SEPARATOR, $class_name) . '.php';
        require_once $classes_dir . $class_file;
    }
});

// Initialize the plugin
// TODO: Initialize the plugin by adding actions, filters and any other setup logic here.
