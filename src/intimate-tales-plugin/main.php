<?php
/**
 * Plugin Name: IntimateTales
 * Plugin URI: https://yourwebsite.com/intimate-tales-plugin
 * Description: An immersive story platform focusing on intimate and personal experiences.
 * Version: 1.0.0
 * Author: DARO
 * Author URI: https://yourwebsite.com/
 * Text Domain: intimate-tales-plugin
 * Domain Path: /languages/
 * License: GPL v2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

// Prevent direct access to the file
if (!defined('ABSPATH')) {
    exit;
}

// Define the constant for the plugin path
if (!defined('INTIMATE_TALES_PLUGIN_PATH')) {
    define('INTIMATE_TALES_PLUGIN_PATH', plugin_dir_path(__FILE__));
}

// Include the main class and the configuration
require_once INTIMATE_TALES_PLUGIN_PATH . 'config.php';
require_once INTIMATE_TALES_PLUGIN_PATH . 'includes/class-main.php';


// Plugin Activation Hook
function intimate_tales_activate() {
    // Any logic that should run on plugin activation
}
register_activation_hook(__FILE__, 'intimate_tales_activate');

// Plugin Deactivation Hook
function intimate_tales_deactivate() {
    // Any logic that should run on plugin deactivation
}
register_deactivation_hook(__FILE__, 'intimate_tales_deactivate');

// Enqueue Plugin Scripts and Styles
function intimate_tales_enqueue_assets() {
    wp_enqueue_style(INTIMATE_TALES_ENQUEUE_PREFIX . 'main_style', INTIMATE_TALES_PLUGIN_URL . 'assets/scss/main.scss', array(), INTIMATE_TALES_VERSION);
    wp_enqueue_script(INTIMATE_TALES_ENQUEUE_PREFIX . 'main_script', INTIMATE_TALES_PLUGIN_URL . 'assets/js/main.js', array('jquery'), INTIMATE_TALES_VERSION, true);
}
add_action('wp_enqueue_scripts', 'intimate_tales_enqueue_assets');

// Load Textdomain for Internationalization
function intimate_tales_load_textdomain() {
    load_plugin_textdomain(INTIMATE_TALES_TEXTDOMAIN, false, dirname(INTIMATE_TALES_PLUGIN_BASENAME) . '/languages/');
}
add_action('plugins_loaded', 'intimate_tales_load_textdomain');

// Include Necessary Plugin Files
require_once INTIMATE_TALES_PLUGIN_PATH . 'includes/class-authentication.php';
require_once INTIMATE_TALES_PLUGIN_PATH . 'includes/class-dashboard.php';
// ... (and so on for other class and utility files)

// Main Plugin Class Initialization (if needed)
$intimateTales = new IntimateTales_Main_Class();
