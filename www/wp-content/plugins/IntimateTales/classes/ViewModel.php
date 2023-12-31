<?php
namespace IntimateTales\Classes;

class ViewModel {
    private static $instance;

    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct() {
        add_action('intimate_tales_handle_onboarding', [$this, 'handle_onboarding_page']);
        add_action('intimate_tales_handle_story', [$this, 'handle_story_page']);
        add_action('intimate_tales_handle_loading', [$this, 'handle_loading_page']);
        add_action('intimate_tales_handle_outcome', [$this, 'handle_outcome_page']);
    }

    public function handle_onboarding_page() {
        if ($this->is_onboarding_completed()) {
            $redirected = wp_redirect(home_url('/story-page'));
            if (false === $redirected) {
                throw new Exception('Failed to redirect the user.');
            }
            exit;
        }

        do_action('intimate_tales_render_onboarding');
    }

    public function handle_story_page() {
        $generated_story = $this->generate_narrative_story();
        $this->save_generated_story($generated_story);
        do_action('intimate_tales_render_story', $generated_story);
    }

    public function handle_loading_page() {
        do_action('intimate_tales_render_loading');
        exit;
    }

    public function handle_outcome_page() {
        $combined_outcome = $this->get_combined_outcome();
        do_action('intimate_tales_render_outcome', $combined_outcome);
        exit;
    }

    /**
     * Handles the submission of the onboarding form data.
     *
     * It processes the form data, saves the user data to the database or user meta,
     * and redirects the user to the story page or another page based on your implementation.
     *
     * @return void
     */
    public function handle_onboarding_submission() {
        if (!empty($_POST['intimate_tales_action']) && $_POST['intimate_tales_action'] === 'onboarding_submit') {
            $this->process_onboarding_submission();
        }
    }

    /**
     * Handles the submission of the user's decision in the interactive story.
     *
     * It processes the decision data, saves it to the database or user meta,
     * and redirects the user to the next page or refreshes the current page based on your implementation.
     *
     * @return void
     */
    public function handle_story_decision() {
        if (!empty($_POST['intimate_tales_action']) && $_POST['intimate_tales_action'] === 'story_decision') {
            $this->process_story_decision();
        }
    }

    /**
     * Generates a narrative story using the NLPModel class.
     *
     * It generates the story text and saves the generated story as a custom post type 'story'.
     * It also assigns the selected categories to the generated story.
     *
     * @return string The generated narrative story text.
     */
    private function generate_narrative_story() {
        // Generate the narrative story using the NLPModel class
        $nlpModel = new NLPModel();
        $story_text = $nlpModel->generate_story();

        // Generate a title for the story
        $story_title = $this->generate_story_title();

        // Save the generated story as a custom post type 'story'
        $story_id = $this->save_story($story_title, $story_text);

        // Get the categories selected by the user in the onboarding process
        $selected_categories = $this->get_selected_categories();

        // Assign the selected categories to the generated story
        $this->assign_categories_to_story($story_id, $selected_categories);

        // Return the generated story text
        return $story_text;
    }

    /**
     * Generates a title for the story.
     *
     * Implement the method to generate a title for the story.
     * You can use any algorithm or logic to create a unique and meaningful title.
     *
     * @return string The generated title for the story.
     */
    private function generate_story_title() {
        // Replace this with your actual logic to generate a unique and meaningful title for the story
        return 'Generated Story'; // For example, you can use a static title
    }

    /**
     * Save a generated story to the 'story' custom post type.
     *
     * @param string $title The title of the story.
     * @param string $content The content of the story.
     * @param array $terms Array of term IDs for the 'story_category' taxonomy.
     * @return int|WP_Error The ID of the inserted post or a WP_Error object on failure.
     */
    private function save_story($story_title, $story_text) {
        // Implement the method to save the generated story as a custom post type 'story'
        $args = array(
            'post_title' => $story_title,
            'post_content' => $story_text,
            'post_type' => 'story',
            'post_status' => 'publish',
        );

        return wp_insert_post($args, true);
    }

    // Other methods for handling user actions and data manipulation can be added here

    // Helper methods can be added here as needed

    // For example, you can add helper methods like get_combined_outcome(),
    // save_generated_story(), is_onboarding_completed(), etc.
}
