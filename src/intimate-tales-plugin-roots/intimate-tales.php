<?php

/**
 * Plugin Name: Intimate Tales
 * Author: Intimate Tales
 * Author URI: https://www.intimate-tales.com
 * Description: This is a description of your plugin.
 * Version: 1.0.0
 * Requires PHP: 8.1
 */

use Roots\Acorn\Bootloader;
use Roots\WPConfig\Config;

/**
 * Require dependencies
 */
require_once dirname(__DIR__, 2) . '/vendor/autoload.php';

/**
 * Set up configuration
 */
Config::define('ACORN_BASEPATH', rtrim(plugin_dir_path(__FILE__) . 'src', '/'));
Config::define('INTIMATE_TALES_FILE', __FILE__);
Config::define('INTIMATE_TALES_URL', plugin_dir_url(__FILE__));
Config::define('INTIMATE_TALES_VERSION', '1.0.0');
Config::define('INTIMATE_TALES_NAME', 'Intimate Tales');
Config::apply();

/**
 * Acorn config
 */
//putenv('APP_RUNNING_IN_CONSOLE=false'); // Uncomment to disable console mode in production. When console mode is enabled, the WP-Cron will not work.
#putenv('ACORN_ENABLE_EXPIRIMENTAL_ROUTER=true');

/**
 * Boot Acorns
 */
$instance = Bootloader::getInstance();
$instance->boot();
