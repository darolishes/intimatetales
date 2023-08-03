<?php

namespace IntimateTales;

defined('ABSPATH') || exit;

use IntimateTales\PostTypeRegistration;
use IntimateTales\TaxonomyRegistration;
use IntimateTales\ACFIntegration;

/**
 * Class Plugin
 * Main plugin class responsible for initializing and handling the plugin functionality.
 */
class Plugin
{
    private static ?self $instance = null;
    private string $version = '1.0.0';
    private string $plugin_file;
    private ACFIntegration $acfIntegration;
    private PostTypeRegistration $post_type_registration;
    private TaxonomyRegistration $taxonomy_registration;

    /**
     * Plugin constructor.
     * @param string $plugin_file
     */
    private function __construct(string $plugin_file)
    {
        $this->plugin_file = $plugin_file;
        $this->initialize_classes();
        $this->register_hooks();
    }

    /**
     * Initialize the plugin classes.
     * @return void
     */
    private function initialize_classes(): void
    {
        $this->post_type_registration = new PostTypeRegistration();
        $this->taxonomy_registration = new TaxonomyRegistration();
        $this->acfIntegration = new ACFIntegration();
    }

    /**
     * Initialize or get the instance of the plugin.
     * @param string $plugin_file
     * @return self
     */
    public static function getInstance(string $plugin_file): self
    {
        if (null === self::$instance) {
            self::$instance = new self($plugin_file);
        }

        return self::$instance;
    }

    /**
     * Enqueue scripts and styles.
     * @return void
     */
    public function enqueue_scripts_and_styles(): void
    {
        $plugin_url = plugin_dir_url($this->plugin_file);
        wp_enqueue_style('intimate-tales', $plugin_url . 'assets/css/intimate-tales.css', [], $this->getVersion(), 'all');
        wp_enqueue_script('intimate-tales', $plugin_url . 'assets/js/intimate-tales.js', ['jquery'], $this->getVersion(), true);
    }

    /**
     * Register hooks for the plugin.
     * @return void
     */
    private function register_hooks(): void
    {
        add_action('init', function() {
            $this->post_type_registration->register_post_types();
            $this->taxonomy_registration->register_taxonomies();
        });
        add_action('acf/init', [$this->acfIntegration, 'add_acf_fields'], 10);
        add_action('plugins_loaded', [$this, 'load_textdomain']);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts_and_styles']);
    }

    /**
     * Load the plugin text domain for translations.
     * @return void
     */
    public function load_textdomain(): void
    {
        load_plugin_textdomain('intimate-tales', false, dirname(plugin_basename($this->plugin_file)) . '/languages');
    }

    /**
     * Get the plugin version.
     * @return string
     */
    public function getVersion(): string
    {
        return $this->version;
    }

    /**
     * Set the plugin version.
     * @param string $version
     * @return self
     */
    public function setVersion(string $version): self
    {
        $this->version = $version;
        return $this;
    }
}
