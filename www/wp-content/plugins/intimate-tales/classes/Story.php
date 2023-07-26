<?php
namespace IntimateTales\Classes;

class Story {
    private $story_text;
    private $decision_points;

    /**
     * Initializes the story object with the provided text and decision points.
     *
     * @param string $story_text The text of the story.
     * @param array $decision_points The interactive decision points within the story.
     */
    public function __construct($story_text, $decision_points) {
        if (!is_string($story_text) || empty($story_text)) {
            trigger_error('Invalid story text provided.', E_USER_ERROR);
            return;
        }

        if (!is_array($decision_points) || empty($decision_points)) {
            trigger_error('Invalid decision points provided.', E_USER_ERROR);
            return;
        }

        $this->story_text = $story_text;
        $this->decision_points = $decision_points;
    }

    /**
     * Renders the story with the interactive decision points.
     *
     * @return string The HTML content of the rendered story.
     */
    public function render() {
        ob_start();
        include INTIMATE_TALES_PLUGIN_DIR . 'templates/story-content.php';
        $story_content = ob_get_clean();
        return $story_content;
    }

    /**
     * Handles the user's decision in the story.
     *
     * @param string $decision The user's decision.
     * @return string The outcome text based on the user's decision.
     */
    public function handle_decision($decision) {
        // Implement the logic to handle the user's decision in the story.
        // ...

        // For example:
        switch ($decision) {
            case 'option1':
                $outcome = 'You chose Option 1. This leads to outcome A.';
                break;
            case 'option2':
                $outcome = 'You chose Option 2. This leads to outcome B.';
                break;
            default:
                $outcome = 'Invalid decision.';
                break;
        }

        // Return the outcome text based on the user's decision.
        return $outcome;
    }
}
