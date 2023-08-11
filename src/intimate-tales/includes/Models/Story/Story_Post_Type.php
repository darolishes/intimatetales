<?php

namespace IntimateTales\Models\Story;

defined('ABSPATH') || exit;

/**
 * Class responsible for registering the 'Story' custom post type.
 */
class Story_Post_Type {

	/**
	 * Constant post type name
	 *
	 * @var string
	 */
	public const Post_Type = 'story';

	/**
	 * Register the custom post type.
	 */
	public function register() {
		$post_type = self::Post_Type;

		if (!post_type_exists($post_type)) {
			$args = array(
				'labels'      => array(
					'name'          => _x('Stories', 'post type general name', 'intimate-tales'),
					'singular_name' => _x('Story', 'post type singular name', 'intimate-tales'),
				),
				'public'      => true,
				'show_ui'     => true,
				'has_archive' => true,
				'rewrite'     => array('slug' => 'stories'),
				'supports'    => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments'),
				// Add other arguments specific to this post type
			);

			register_post_type($post_type, $args);

			// Maybe flush the rewrite rules if necessary
			// flush_rewrite_rules();
		}
	}

	/**
	 * Add custom metaboxes or ACF fields.
	 */
	public function add_custom_fields() {
		// Logic to add custom fields or metaboxes
	}

	/**
	 * Register custom taxonomies.
	 */
	public function register_taxonomies() {
		// Logic to register custom taxonomies
	}

	/**
	 * Modify permalink structure.
	 */
	public function modify_permalink_structure() {
		// Logic to modify the permalink structure
	}
}
