<?php

/**
 * Plugin Name: IntimateTales
 * Description: A WordPress plugin for the IntimateTales platform.
 * Version: 1.0.0
 * Author: Dawid Rogaczewski
 * Author URI: https://www.yourwebsite.com
 * Text Domain: intimate-tales
 */
defined( 'ABSPATH' ) || exit;

// Include the main plugin class.
require_once plugin_dir_path( __FILE__ ) . 'app/setup.php';

// Initialize the plugin.
add_action( 'plugins_loaded', function () {
    $setup = new IntimateTales\Setup();
    $setup->init();
} );
