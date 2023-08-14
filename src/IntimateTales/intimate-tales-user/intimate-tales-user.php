
<?php
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
defined('ABSPATH') || exit;

// Define constants for the plugin
define('INTIMATE_TALES_USER_DIR_PATH', plugin_dir_path(__FILE__));
define('INTIMATE_TALES_USER_DIR_URL', plugin_dir_url(__FILE__));

// Include necessary files


// Initialization code if needed
if (!function_exists('intimate_tales_user_init')) {
    function intimate_tales_user_init() {
        // TODO: Add any plugin initialization code here
    }
    add_action('init', 'intimate_tales_user_init');
}
