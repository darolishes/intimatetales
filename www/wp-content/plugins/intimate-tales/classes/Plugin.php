<?php

namespace IntimateTales;
use IntimateTales\Classes\User;
use IntimateTales\Classes\ContentRegistration;

// Exit if accessed directly.
defined('ABSPATH') || exit;

/**
 * Class Plugin
 * Main plugin class responsible for initializing and handling the plugin functionality.
 */
class Plugin {
    private static $instance = null;

    /**
     * Plugin version.
     *
     * @var string
     */
    private $version = '1.0.0';

    /**
     * Get the single instance of the class.
     *
     * @return Plugin
     */
    public static function get_instance(): Plugin {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Constructor to initialize the plugin.
     */
    private function __construct() {
        add_action('init', [$this, 'on_init']);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts_and_styles']);
    }

    public function on_init(): void {
        $this->load_textdomain();
        $this->register_custom_post_type_taxonomy();
        // Assuming User::get_instance() exists and is relevant here
        User::get_instance();
        $this->initialize_authentication();
        $this->initialize_monetization();
        $this->initialize_encryption();
    }

    /**
     * Load the plugin text domain for translations.
     */
    public function load_textdomain(): void {
        load_plugin_textdomain('intimate-tales', false, INTIMATE_TALES_PLUGIN_DIR . 'languages');
    }

    /**
     * Register custom post type 'story' and custom taxonomy 'story_category'.
     */
    private function register_custom_post_type_taxonomy(): void {
        $content_registration = new ContentRegistration();
        $content_registration->register_story_post_type();
        $content_registration->register_story_taxonomies();
    }

    /**
     * Enqueue frontend scripts and styles.
     */
    public function enqueue_scripts_and_styles() {
        // Enqueue your frontend scripts here
        wp_enqueue_script('intimate-tales-script', INTIMATE_TALES_PLUGIN_URL . 'js/my-script.js', array('jquery'), $this->version, true);

        // Enqueue your frontend styles here
        wp_enqueue_style('intimate-tales-style', INTIMATE_TALES_PLUGIN_URL . 'css/my-style.css', array(), $this->version);
    }

    /**
     * Initialize the authentication functionalities.
     * Implement your authentication logic here.
     */
    public function initialize_authentication() {
        // TODO: Implement authentication logic.
        // Example: Add hooks for login, logout, registration, etc.
    }

    /**
     * Initialize the monetization functionalities.
     * Implement your monetization logic here.
     */
    public function initialize_monetization() {
        // TODO: Implement monetization logic.
        // Example: Add hooks for in-app purchases, subscriptions, ads, etc.
    }

    /**
     * Initialize the encryption functionalities.
     * Implement your encryption logic here.
     */
    public function initialize_encryption() {
        // TODO: Implement encryption logic.
        // Example: Add hooks for encrypting and decrypting data.
    }
}
