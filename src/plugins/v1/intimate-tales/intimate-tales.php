<?php

/**
 * Plugin Name: Intimate Tales
 * Description: A WordPress plugin for the IntimateTales platform.
 * Version: 1.0.0
 * Requires PHP: 8.0
 * Author: Dawid Rogaczewski
 * Author URI: [https://www.intimate-tales.de ↗](https://www.intimate-tales.de)
 * Text Domain: intimate-tales
 * Domain Path: /languages
 */

if (!defined('ABSPATH')) {
    exit;
}

define('INTIMATE_TALES_DIR_PATH', untrailingslashit(plugin_dir_path(__FILE__)));

use IntimateTales\Admin\Admin;
use IntimateTales\Helper\Acf\Acf_Helper;

/**
 * Main IntimateTales Class
 */
final class IntimateTales {
    const VERSION = '1.0.0';

    private static $instance;
    private $version;
    private Admin $admin;
    private $file;
    private $path;

    public static function instance() {
        if (!isset(self::$instance) && !(self::$instance instanceof IntimateTales)) {
            self::$instance = new IntimateTales();
        }
        return self::$instance;
    }

    /**
     * Private constructor to prevent creating a new instance of the
     * Singleton via the `new` operator from outside of this class.
     */
    private function __construct() {
        $this->version = self::VERSION;
        $this->file = __FILE__;
        $this->path = plugin_dir_path($this->file);
        $this->admin = new Admin;
        $this->setup_hooks();
    }


    /**
     * Set up hooks and constants.
     *
     * @access private
     */
    private function setup_hooks() {
        add_action('init', [$this, 'init_plugin']);
        add_action('plugins_loaded', [$this, 'load_textdomain']);
    }

    /**
     * Initialize plugin's textdomain.
     */
    public function load_textdomain() {
        $plugin_dir = dirname(dirname(plugin_basename(__FILE__)));
        load_plugin_textdomain('intimate-tales', false, $plugin_dir . '/languages/');
    }

    /**
     * Initialize plugin.
     */
    public function init_plugin() {
        // enqueue styles and localization to frondend
        add_action('wp_enqueue_styles', [$this, 'enqueue_styles']);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);
    }

    /**
     * Enqueue styles.
     */
    public function enqueue_styles() {
        wp_enqueue_style('intimate-tales-style', plugins_url('assets/css/style.css', __FILE__), [], $this->version);
    }

    /**
     * Enqueue scripts.
     */
    public function enqueue_scripts() {
        wp_enqueue_script('intimate-tales-script', plugins_url('assets/js/script.js', __FILE__), [], $this->version, true);
        wp_localize_script('intimate-tales-script', 'intimate_tales_script', [
            'ajax_url' => admin_url('admin-ajax.php'),
        ]);
    }

    /**
     * Return plugin's version.
     *
     * @return string
     */
    public function get_version() {
        return $this->version;
    }
}

/**
 * Returns the main instance of IntimateTales.
 *
 * @since 1.0.0
 * @return IntimateTales The main instance of IntimateTales.
 */
function intimate_tales() {
    return IntimateTales::instance();
}

// Get it started
intimate_tales();
