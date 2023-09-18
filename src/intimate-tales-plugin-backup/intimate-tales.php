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
 * Text Domain:       intimate-tales
 * Domain Path:       /languages
 */

if (!defined('WPINC')) {
    die;
}


#require plugin_dir_path(__FILE__) . 'vendor/autoload.php';

$intimateTalesPlugin = new IntimateTalesPlugin(new MainController(new Config(), new Loader()));
register_activation_hook(__FILE__, [$intimateTalesPlugin, 'activate']);
register_deactivation_hook(__FILE__, [$intimateTalesPlugin, 'deactivate']);
$intimateTalesPlugin->run();
