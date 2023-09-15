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
 * 
 * @package IntimateTalesPlugin
 */

// Prevent direct access to the file
if (!defined('ABSPATH')) {
    exit;
}

// Include configuration and shared dependencies.
require_once dirname(__FILE__) . '/config.php';

// Instantiate main class
$intimateTales = new IntimateTales();

// Run the plugin
$intimateTales->run();
