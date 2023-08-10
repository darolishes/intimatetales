<?php

/**
 * Plugin Name: IntimateTales
 * Plugin URI: https://www.intimatetales.com
 * Description: A WordPress plugin for the IntimateTales platform.
 * Version: 1.0.0
 * Author: Dawid Rogaczewski
 * Author URI: https://www.yourwebsite.com
 * Text Domain: intimate-tales
 * Domain Path: /languages/
 */

namespace IntimateTales;

defined('ABSPATH') || exit;

// Define constants
define('INTIMATE_TALES_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('INTIMATE_TALES_CLASSES_DIR', INTIMATE_TALES_PLUGIN_DIR . 'classes/');

/**
 * Load the plugin's text domain for localization purposes.
 */
load_plugin_textdomain(
    'intimate-tales',
    false,
    INTIMATE_TALES_PLUGIN_DIR . '/languages'
);
