<?php

/**
 * Plugin Name: Intimate Tales - Rollenspiel Modul
 * Description: Ein Rollenspiel-Modul für das Haupt-Plugin "Intimate Tales".
 * Version: 1.0.0
 * Author: [Your Name or Company]
 * Text Domain: intimate-tales-rollenspiel
 */

// Ensure direct access is blocked
if (!defined('ABSPATH')) {
    exit;
}

namespace IntimateTales;

class Main_Plugin {

    private static $instance;

    private $template_loader;
    private $story_manager;
    private $character_manager;
    private $user_progress_manager;
    private $interaction_manager;
    private $feedback_manager;
    private $api_integration_manager;
    private $character_attributes_manager;
    private $game_settings_manager;
    private $achievements_manager;

    private function __construct() {
        // Initialisierung der Manager-Klassen und anderer Funktionen
        $this->init_managers();
    }

    public static function get_instance() {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function init_managers() {
        $this->template_loader = new Template_Loader();
        $this->story_manager = new Story_Manager();
        $this->character_manager = new Character_Manager();
        $this->user_progress_manager = new User_Progress_Manager();
        $this->interaction_manager = new Interaction_Manager();
        $this->feedback_manager = new Feedback_Manager();
        $this->api_integration_manager = new API_Integration_Manager('https://api.example.com');
        $this->character_attributes_manager = new Character_Attributes_Manager();
        $this->game_settings_manager = new Game_Settings_Manager();
        $this->achievements_manager = new Achievements_Manager();
    }

    public function init() {
        add_action('init', array($this, 'register_custom_post_types'));
        add_action('init', array($this, 'register_custom_taxonomies'));
        add_action('admin_menu', array($this, 'add_admin_menu'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_scripts'));

        // Weitere Aktionen und Hooks hinzufügen

        add_shortcode('intimate_tales', array($this, 'intimate_tales_shortcode'));
    }

    public function register_custom_post_types() {
        // Registrierung benutzerdefinierter Post-Typen
    }

    public function register_custom_taxonomies() {
        // Registrierung benutzerdefinierter Taxonomien
    }

    public function add_admin_menu() {
        // Hinzufügen von Menüpunkten zum Administrationspanel
    }

    public function enqueue_scripts() {
        // Einbinden von CSS und JavaScript für das Frontend
    }

    public function enqueue_admin_scripts() {
        // Einbinden von CSS und JavaScript für das Administrationspanel
    }

    public function intimate_tales_shortcode($atts) {
        // Verarbeitung des Shortcodes und Anzeige des Frontend-Inhalts
    }
}
