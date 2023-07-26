<?php
namespace IntimateTales;

use IntimateTales\PostType;
use IntimateTales\Taxonomy;
use IntimateTales\Settings;
use IntimateTales\Acf;
use IntimateTales\RestAPI;

defined('ABSPATH') || exit;

class Plugin {
    protected $post_type;
    protected $taxonomy;
    protected $acf;
    protected $settings;
    protected $rest_api;

    protected static $instance = null;

    /**
     * Get the instance of the Plugin class.
     *
     * @since 1.0.0
     * @return Plugin|null The Plugin instance.
     */
    public static function get_instance() {
        if (self::$instance === null) {
            self::$instance = new self();
            self::$instance->setup();
        }
        return self::$instance;
    }

    /**
     * Plugin constructor.
     *
     * @since 1.0.0
     */
    private function __construct() {}

    /**
     * Initialize the Plugin.
     *
     * @since 1.0.0
     */
    public function setup() {
        $this->settings = new Settings();
        $this->post_type = new PostType($this->settings);
        $this->taxonomy = new Taxonomy($this->settings);
        $this->acf = Acf::get_instance();
        $this->acf->register();
        $this->rest_api = new RestAPI($this->settings);
    
        add_action('init', [$this, 'init']);
    }

    public function init() {
        $this->post_type->register();
        $this->taxonomy->register();
    }
}