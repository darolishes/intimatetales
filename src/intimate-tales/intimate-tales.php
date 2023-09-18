<?php

/**
 * Plugin Name:        Intimate Tales
 * Plugin URI:         https://intimatetales.com/
 * Description:        A collection of modules to apply theme-agnostic front-end modifications to WordPress.
 * Version:            1.0.0
 * Author:             Dawid Rogaczewski
 * Author URI:         https://intimatetales.com/
 *
 * Text Domain:        intimate-tales
 * Domain Path:        /i18n/languages/
 * Requires at least:  6.2
 * Requires PHP:       7.4
 *
 * @package IntimateTales
 */

// Prevent direct access to file
if (!defined('ABSPATH')) {
    exit;
}

// Load the Composer autoload file (generated by Composer)
require_once plugin_dir_path(__FILE__) . '/vendor/autoload.php';

// Use the required classes from the IntimateTales namespace
use IntimateTales\Constants;
use IntimateTales\Core;

// Initialize the Constants class
$constants = new Constants();

// Run the plugin
Core::instance($constants)->run();
