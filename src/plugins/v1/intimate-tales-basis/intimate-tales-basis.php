<?php

/**
 * Plugin Name: Intimate Tales - Basis Plugin
 * Description: The foundational plugin for the IntimateTales platform.
 * Version: 1.0.0
 * Requires PHP: 8.0
 * Author: Dawid Rogaczewski
 * Author URI: https://www.intimate-tales.de
 * Text Domain: intimate-tales-basis
 * Domain Path: /languages
 */

 /**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-intimate-tales-basis.php
 */
function activate_intimate_tales_basis() {
    require_once plugin_dir_path( __FILE__ ). 'includes/class-intimate-tales-basis.php';
    Intimate_Tales_Basis::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-intimate-tales-basis.php
 */
function deactivate_intimate_tales_basis() {
    require_once plugin_dir_path( __FILE__ ). 'includes/class-intimate-tales-basis.php';
    Intimate_Tales_Basis::deactivate();
}

register_activation_hook( __FILE__, 'activate_intimate_tales_basis' );
register_deactivation_hook( __FILE__, 'deactivate_intimate_tales_basis' );