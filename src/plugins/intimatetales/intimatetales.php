<?php
/*
Plugin Name: IntimateTales
Description: A platform for immersive storytelling, integrating WordPress with mobile application for a personalized experience using modern AI technologies.
Version: 1.0
Author: Your Name
*/

// Define plugin directory path and URL
define('PLUGIN_DIR_PATH', plugin_dir_path(__FILE__));
define('PLUGIN_URL', plugin_url(__FILE__));

// Include dependencies
require_once PLUGIN_DIR_PATH . 'includes/custom-post-types.php';
require_once PLUGIN_DIR_PATH . 'includes/rest-api-endpoints.php';
require_once PLUGIN_DIR_PATH . 'includes/security.php';
require_once PLUGIN_DIR_PATH . 'includes/woocommerce-integration.php';
require_once PLUGIN_DIR_PATH . 'admin/settings-page.php';
require_once PLUGIN_DIR_PATH . 'includes/user-management.php';

// Activation Hook
register_activation_hook(__FILE__, 'intimatetales_activate');
function intimatetales_activate() {
    // Code to execute during plugin activation
    create_cpts();
    flush_rewrite_rules();
}

// Deactivation Hook
register_deactivation_hook(__FILE__, 'intimatetales_deactivate');
function intimatetales_deactivate() {
    // Code to execute during plugin deactivation
    flush_rewrite_rules();
}

// Register Custom Post Types
add_action('init', 'create_cpts');

// Register REST API Routes
add_action('rest_api_init', 'register_rest_routes');

// WooCommerce Integration
add_action('woocommerce_loaded', 'woocommerce_integration_functions');

// Enqueue Scripts and Styles
function intimatetales_enqueue_scripts() {
    wp_enqueue_script('intimatetales-script', PLUGIN_URL . 'public/js/script.js', array('jquery'), null, true);
    wp_enqueue_style('intimatetales-style', PLUGIN_URL . 'public/css/style.css');
}
add_action('wp_enqueue_scripts', 'intimatetales_enqueue_scripts');

// User Authentication Hooks
add_action('wp_login', 'authenticate_user');
add_action('wp_logout', 'user_logout_cleanup');

// Analytics Event Tracking
add_action('wp_head', 'analytics_event_tracking');
