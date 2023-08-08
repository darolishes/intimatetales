<?php
/**
 * Plugin Name: IntimateTales
 * Description: A WordPress plugin for displaying intimate tales.
 * Version: 1.0.0
 * Author: Your Name
 * Author URI: https://yourwebsite.com
 * Text Domain: intimate-tales
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

// Include the main plugin class.
require_once plugin_dir_path(__FILE__) . 'includes/class-intimate-tales-plugin.php';

// Initialize the plugin.
function intimate_tales_init() {
    $plugin = new IntimateTalesPlugin();
    $plugin->init();
}
add_action('plugins_loaded', 'intimate_tales_init');
