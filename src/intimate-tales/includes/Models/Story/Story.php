<?php

namespace IntimateTales\Models\Story;

use IntimateTales\Functions;

defined( 'ABSPATH' ) || exit;

class Story {

	private $post_type;
	private $taxonomies;
	private $post_id;

	public function __construct( int $post_id, Story_Post_Type $post_type, Story_Taxonomies $taxonomies ) {
		$this->post_type  = $post_type;
		$this->taxonomies = $taxonomies;
		$this->post_id    = $post_id;
	}

	public function register() {
		$this->post_type->register_post_type();
		$this->taxonomies->register_taxonomies();
		// We can expand this for other inits related to stories, like registering custom endpoints, etc.
	}

	public function display_acf_fields() {
		$fields = get_field_objects( $this->post_id );

		if ( $fields ) {
			foreach ( $fields as $field_name => $field ) {
				?>
				<div>
					<strong><?php echo esc_html( $field['label'] ); ?>:</strong>
					<?php echo esc_html( $field['value'] ); ?>
				</div>
				<?php
			}
		}
	}

	/**
	 * Renders the story with the interactive decision points.
	 *
	 * @return string The HTML content of the rendered story.
	 */
	public function render() {
		ob_start();
		include Functions::get_plugin_file() . 'templates/story-content.php';
		return ob_get_clean();
	}

	/**
	 * Handles the user's decision in the story.
	 *
	 * @param string $decision The user's decision.
	 *
	 * @return string The outcome text based on the user's decision.
	 */
	public function handle_decision( $decision ) {
		// Implement the logic to handle the user's decision in the story.

		switch ( $decision ) {
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

		return $outcome;
	}

	public function get_personalized_story( $user_id ) {
		// Load user data (preferences/dislikes)
		$user_data = get_user_meta( $user_id, 'story_preferences', true );

		// Use the AI model to generate a personalized story based on the user data
		$personalized_story = $this->ai_model->predict( $user_data );

		return $personalized_story;
	}
}
