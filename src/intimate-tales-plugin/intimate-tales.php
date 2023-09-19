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

namespace App\Plugin;

if (!defined('WPINC')) {
    die;
}

use Roots\Acorn\Bootloader;
use Roots\WPConfig\Config;

require_once dirname(__DIR__, 2) . '/vendor/autoload.php';

/**
 * Set up configuration
 */
Config::define('INTIMATE_TALES_FILE', __FILE__);
Config::define('INTIMATE_TALES_DIR', plugin_dir_path(__FILE__));
Config::define('INTIMATE_TALES_BASENAME', plugin_basename(__FILE__));
Config::define('INTIMATE_TALES_URL', plugin_dir_url(__FILE__));
Config::define('INTIMATE_TALES_VERSION', '1.0.0');
Config::define('INTIMATE_TALES_NAME', 'Intimate Tales');
#Config::define('ACORN_BASEPATH', rtrim(plugin_dir_path(__FILE__) . 'src', '/'));

Config::apply();

/**
 * Set up bootloader
 */
$bootloader = new Bootloader();
$bootloader->boot();
