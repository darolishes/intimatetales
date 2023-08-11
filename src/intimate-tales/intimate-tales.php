<?php

namespace IntimateTales;

/**
 * Plugin Name: Intimate Tales
 * Description: A WordPress plugin for the IntimateTales platform.
 * Version: 1.0.0
 * Requires at least: 5.9
 * Requires PHP: 8.0
 * Author: Dawid Rogaczewski
 * Author URI: https://www.yourwebsite.com
 * Text Domain: intimate-tales
 *
 * @package IntimateTales
 */

defined('ABSPATH') || exit;

define('INTIMATE_TALES_VERSION', '1.0.0');
define('INTIMATE_TALES_FILE', __FILE__);
define('INTIMATE_TALES_DIR', plugin_dir_path(__FILE__));

new Plugin();
