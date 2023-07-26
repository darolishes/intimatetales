<?php
namespace IntimateTales;

defined('ABSPATH') || exit;

use IntimateTales\ContentRegistration;
use IntimateTales\ACFIntegration;
use IntimateTales\UserPreferences;
use IntimateTales\StoryMatching;
use IntimateTales\CustomStoryCreator;
use IntimateTales\AuthorRecommendation;
use IntimateTales\StoryCustomization;
use IntimateTales\UserDashboard;
use IntimateTales\NotificationManager;
use IntimateTales\GiftsAndPromotions;
use IntimateTales\FrontendScriptsStyles;
use IntimateTales\BackgroundProcesses;

/**
 * Class Plugin
 * Main plugin class responsible for initializing and handling the plugin functionality.
 */
class Plugin
{
    /**
     * @var Plugin
     */
    private static $instance;

    /**
     * @var string
     */
    private $version = '1.0.0';

    /**
     * Plugin constructor.
     */
    private function __construct()
    {
        // Initialisierung aller Klassen
        $this->initialize_authentication();
        $this->initialize_monetization();
        $this->initialize_encryption();
        $this->initialize_analytics();
        $this->initialize_push_notifications();
        $this->initialize_social_sharing();
        $this->initialize_offline();
        $this->initialize_caching();

        $content = new ContentRegistration();
        $acf_integration = new ACFIntegration();
    }


    /**
     * Initialize the plugin.
     * @return Plugin
     */
    public static function init(): self
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Enqueue_scripts_and_styles
     * @return void
     */
    public function enqueue_scripts_and_styles(): void
    {
        wp_enqueue_style('intimate-tales', INTIMATE_TALES_PLUGIN_URL . 'assets/css/intimate-tales.css', [], $this->getVersion(), 'all');
        wp_enqueue_script('intimate-tales', INTIMATE_TALES_PLUGIN_URL . 'assets/js/intimate-tales.js', ['jquery'], $this->getVersion(), true);
    }

    /**
     * Register the hooks for the plugin.
     * @return void
     */
    private function register_hooks(): void
    {
        add_action('plugins_loaded', [$this, 'load_textdomain']);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts_and_styles']);
    }
    /**
     * Load the plugin text domain for translations.
     * @return void
     */
    public function load_textdomain(): void
    {
        load_plugin_textdomain('intimate-tales', false, INTIMATE_TALES_PLUGIN_DIR . 'languages');
    }

    /**
     * Initialize the authentication functionalities.
     * 
     * @return void
     */
    public function initialize_authentication()
    {
        // TODO: Implement authentication logic.

        #add_action('wp_login', [$this, 'on_user_login'], 10, 2);
        #add_action('wp_logout', [$this, 'on_user_logout']);
        #add_action('user_register', [$this, 'on_user_register']);
    }

    /**
     * Initialize the monetization functionalities.
     * 
     * @return void
     */
    public function initialize_monetization()
    {
        // TODO: Implement monetization logic.
        // Example: Add hooks for in-app purchases, subscriptions, ads, etc.

    }

    /**
     * Initialize the encryption functionalities.
     * Implement your encryption logic here.
     */
    public function initialize_encryption()
    {
        // TODO: Implement encryption logic.
        // Example: Add hooks for encrypting and decrypting data.
    }

    /**
     * Initialize the analytics functionalities.
     * Implement your analytics logic here.
     */
    public function initialize_analytics()
    {

    }

    /**
     * Initialize the push notification functionalities.
     * Implement your push notification logic here.
     */
    public function initialize_push_notifications()
    {

    }

    /**
     * Initialize the social sharing functionalities.
     * Implement your social sharing logic here.
     */
    public function initialize_social_sharing()
    {

    }

    /**
     * Initialize the offline functionalities.
     * Implement your offline logic here.
     */
    public function initialize_offline()
    {

    }

    /**
     * Initialize the caching functionalities.
     * Implement your caching logic here.
     */
    public function initialize_caching()
    {

    }

    /**
     * Initialize the background sync functionalities.
     * Implement your background sync logic here.
     */
    public function initialize_background_sync()
    {

    }

    /**
     * Initialize the background geolocation functionalities.
     * Implement your background geolocation logic here.
     */
    public function initialize_background_geolocation()
    {

    }

    /**
     * Initialize the background fetch functionalities.
     * Implement your background fetch logic here.
     */
    public function initialize_background_fetch()
    {

    }

    /**
     * Initialize the background notification functionalities.
     * Implement your background notification logic here.
     */
    public function initialize_background_notification()
    {

    }

    /**
     * Initialize the background periodic functionalities.
     * Implement your background periodic logic here.
     */
    public function initialize_background_periodic()
    {

    }

    /**
     * Initialize the background connectivity functionalities.
     * Implement your background connectivity logic here.
     */
    public function initialize_background_connectivity()
    {

    }

    /**
     * Initialize the background bluetooth functionalities.
     * Implement your background bluetooth logic here.
     */
    public function initialize_background_bluetooth()
    {

    }

    /**
     * Initialize the background device functionalities.
     * Implement your background device logic here.
     */
    public function initialize_background_device()
    {

    }

    /**
     * Initialize the background timer functionalities.
     * Implement your background timer logic here.
     */
    public function initialize_background_timer()
    {

    }

    /**
     * Initialize the background alarm functionalities.
     * Implement your background alarm logic here.
     */
    public function initialize_background_alarm()
    {

    }

    /**
     * Initialize the background location functionalities.
     * Implement your background location logic here.
     */
    public function initialize_background_location()
    {

    }

    /**
     * 
     * @return Plugin
     */
    public static function getInstance()
    {
        return self::$instance;
    }

    /**
     * 
     * @param Plugin $instance 
     */
    public static function setInstance($instance)
    {
        self::$instance = $instance;
        return;
    }

    /**
     * 
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * 
     * @param string $version 
     * @return self
     */
    public function setVersion($version): self
    {
        $this->version = $version;
        return $this;
    }
}