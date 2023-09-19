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

define('INTIMATE_TALES_VERSION', '1.0.0');
define('INTIMATE_TALES_DIR', plugin_dir_path(__FILE__));
define('INTIMATE_TALES_URL', plugin_dir_url(__FILE__));
define('INTIMATE_TALES_BASENAME', plugin_basename(__FILE__));

require_once dirname(__DIR__, 2) . '/vendor/autoload.php';

remove_action('template_redirect', 'redirect_canonical');

use \IntimateTales\Config\PluginConfig;
use \IntimateTales\Controllers\Loader;
use \IntimateTales\Controllers\AppController;

$intimateTalesPlugin = new AppController(new PluginConfig(), new Loader());
$intimateTalesPlugin->run();
