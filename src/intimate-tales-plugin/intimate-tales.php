<?php
/*
 * Plugin Name:       Intimate Tales
 * Plugin URI:        https://intimate-tales.com/
 * Description:       ...
 * Version:           1.0.0
 * Author:            Intimate Tales Team
 * Author URI:        https://intimate-tales.com/
 * License:           
 * License URI:       
 * Text Domain:       intimatetales
 * Domain Path:       /languages
 */


// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

function it_settings_link($links)
{
    $url = get_admin_url() . 'admin.php';
    $settings_link = '<a href="' . $url . '">' . __('Settings', 'intimatetales') . '</a>';
    array_unshift($links, $settings_link);
    return $links;
}
add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'it_settings_link');

/**
 * Plugin version. - https://semver.org
 *
 */
define('INTIMATE_TALES_LIKES_VERSION', '1.0.0');

/**
 * Activation
 */
function activate_intimate_tales()
{
    IntimateTales\Core\Controllers\App\IntimateTalesActivator::activate();
}

/**
 * Deactivation.
 */
function deactivate_intimate_tales()
{
    // IntimateTales\Core\Controllers\App\IntimateTalesDeactivator::deactivate();
}

/**
 * Deinstallation.
 */
function deinstall_intimate_tales()
{
}

/**
 * Watch the Namespace syntax. Shoutout:
 * https://developer.wordpress.org/reference/functions/register_activation_hook/#comment-2167
 */
// register_activation_hook( __FILE__, __NAMESPACE__ . '\activate_intimate_tales' );
// register_deactivation_hook( __FILE__, __NAMESPACE__ . '\deactivate_intimate_tales' );
// register_uninstall_hook( __FILE__, __NAMESPACE__ . '\deinstall_intimate_tales' );
/**
 * Instead of: register_activation_hook( __FILE__, 'activate_intimate_tales' );
 * Using the file constant did not work for me.
 */


// include the Composer autoload file
require plugin_dir_path(__FILE__) . 'vendor/autoload.php';

/**
 * Engage.
 */
function run_intimate_tales()

    $plugin = new IntimateTales\Core\Controllers\App\IntimateTalesCore();
    $plugin->run();
}
run_intimate_tales();