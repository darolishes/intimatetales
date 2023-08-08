<?php
namespace IntimateTales\Includes;

class ActionHandler {
    private static $instance;

    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct() {
        // Initialize the ActionHandler class here
        $this->register_hooks();
    }

    private function register_hooks() {
        // Add hooks for handling different actions
        add_action('wp_ajax_handle_onboarding_submission', [$this, 'handle_onboarding_submission']);
        add_action('wp_ajax_nopriv_handle_onboarding_submission', [$this, 'handle_onboarding_submission']);
        add_action('wp_ajax_handle_story_decision', [$this, 'handle_story_decision']);
        add_action('wp_ajax_nopriv_handle_story_decision', [$this, 'handle_story_decision']);
        add_action('wp_ajax_handle_sound_effects_toggle', [$this, 'handle_sound_effects_toggle']);
        add_action('wp_ajax_nopriv_handle_sound_effects_toggle', [$this, 'handle_sound_effects_toggle']);
    }

   /**
     * Handles the submission of the onboarding form.
     * Ajax action: wp_ajax_handle_onboarding_submission
     *             wp_ajax_nopriv_handle_onboarding_submission (for non-logged-in users)
     *
     * @return void
     */
    public function handle_onboarding_submission() {
        // Verify the nonce
        if (!isset($_POST['onboarding_nonce']) || !wp_verify_nonce($_POST['onboarding_nonce'], 'handle_onboarding_submission')) {
            // Handle invalid nonce...
            wp_die('Invalid nonce.');
        }

        // Validate and sanitize form data
        $intimacy_level = isset($_POST['intimacy_level']) ? absint($_POST['intimacy_level']) : null; // Ensure $intimacy_level is a non-negative integer
        $desired_scenarios = isset($_POST['desired_scenarios']) ? sanitize_text_field($_POST['desired_scenarios']) : null; // Sanitize as a text field
        $role_playing_themes = isset($_POST['role_playing_themes']) ? sanitize_text_field($_POST['role_playing_themes']) : null; // Sanitize as a text field

        // Handle form submission...

        wp_die(); // Die to end the execution of the script
    }

    /**
     * Handles the user's decision in the interactive story.
     * Ajax action: wp_ajax_handle_story_decision
     *             wp_ajax_nopriv_handle_story_decision (for non-logged-in users)
     *
     * @return void
     */
    public function handle_story_decision() {
        // Implement the logic to handle the user's decision in the interactive story
        // For example, save the user's decision and provide the next part of the story.

        // Make sure to handle security and data validation, such as using nonces to verify the request.

        // Your implementation goes here.
    }

    /**
     * Handles the sound effects toggle in the user interface.
     * Ajax action: wp_ajax_handle_sound_effects_toggle
     *             wp_ajax_nopriv_handle_sound_effects_toggle (for non-logged-in users)
     *
     * @return void
     */
    public function handle_sound_effects_toggle() {
        // Implement the logic to handle the sound effects toggle in the user interface
        // For example, save the user's sound effects preference and update the settings.

        // Make sure to handle security and data validation, such as using nonces to verify the request.

        // Your implementation goes here.
    }
}
