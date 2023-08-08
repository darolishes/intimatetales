<?php
namespace IntimateTales;

/**
 * Plugin Name: IntimateTales
 * Plugin URI: https://www.intimatetales.com
 * Description: A WordPress plugin for the IntimateTales platform.
 * Version: 1.0.0
 * Author: Dawid Rogaczewski
 * Author URI: https://www.yourwebsite.com
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: intimate-tales
 * Domain Path: /languages
 */
 
defined('ABSPATH') || exit;

// Define constants
define('INTIMATE_TALES_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('INTIMATE_TALES_CLASSES_DIR', INTIMATE_TALES_PLUGIN_DIR . 'classes/');

// Autoload classes
spl_autoload_register(function ($class_name) {
    $class_name = str_replace('IntimateTales\\', '', $class_name);
    $class_file = INTIMATE_TALES_CLASSES_DIR . $class_name . '.php';
    if (file_exists($class_file)) {
        require_once $class_file;
    }
});

use IntimateTales\PostTypeRegistration;
use IntimateTales\TaxonomyRegistration;
use IntimateTales\ACFIntegration;

class IntimateTales
{
    private static ?self $instance = null;
    private string $version = '1.0.0';
    private string $plugin_file;
    private ACFIntegration $acfIntegration;
    private PostTypeRegistration $post_type_registration;
    private TaxonomyRegistration $taxonomy_registration;

    private function __construct(string $plugin_file)
    {
        $this->plugin_file = $plugin_file;
        $this->register_hooks();
    }

    public static function getInstance(string $plugin_file): self
    {
        return self::$instance ??= new self($plugin_file);
    }

    private function register_hooks(): void
    {
        add_action('init', function() {
            $this->post_type_registration = new PostTypeRegistration();
            $this->post_type_registration->register_post_types();

            $this->taxonomy_registration = new TaxonomyRegistration();
            $this->taxonomy_registration->register_taxonomies();
        });

        add_action('plugins_loaded', [$this, 'load_textdomain']);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts_and_styles']);

        $this->acfIntegration = new ACFIntegration();
    }

    public function enqueue_scripts_and_styles(): void
    {
        $plugin_url = plugin_dir_url($this->plugin_file);
        wp_enqueue_style('intimate-tales', $plugin_url . 'assets/css/intimate-tales.css', [], $this->getVersion(), 'all');
        wp_enqueue_script('intimate-tales', $plugin_url . 'assets/js/intimate-tales.js', ['jquery'], $this->getVersion(), true);
    }

    public function load_textdomain(): void
    {
        load_plugin_textdomain('intimate-tales', false, dirname(plugin_basename($this->plugin_file)) . '/languages');
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    public function setVersion(string $version): self
    {
        $this->version = $version;
        return $this;
    }
}

// Initialize the plugin if the class exists
if (class_exists('IntimateTales\IntimateTales')) {
    IntimateTales::getInstance(__FILE__);
}