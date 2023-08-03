<?php
namespace IntimateTales\Classes;

class View {
    private static $instance;

    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct() {
        $this->register_hooks();
    }

    private function register_hooks() {
        add_action('intimate_tales_render_onboarding', [$this, 'render_onboarding_page']);
        add_action('intimate_tales_render_story', [$this, 'render_story_page']);
        add_action('intimate_tales_render_loading', [$this, 'render_loading_page']);
        add_action('intimate_tales_render_outcome', [$this, 'render_outcome_page']);
    }

    public function render_onboarding_page() {
        include(INTIMATE_TALES_PLUGIN_DIR . 'templates/onboarding-form.php');
    }

    public function render_story_page($generated_story) {
        include(INTIMATE_TALES_PLUGIN_DIR . 'templates/story-page.php');
    }

    public function render_loading_page() {
        include(INTIMATE_TALES_PLUGIN_DIR . 'templates/loading-page.php');
    }

    public function render_outcome_page($combined_outcome) {
        include(INTIMATE_TALES_PLUGIN_DIR . 'templates/outcome-page.php');
    }

    // Add other methods for rendering additional views here
}
