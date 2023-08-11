<?php

namespace IntimateTales\Models\Story;

defined('ABSPATH') || exit;

/**
 * Class responsible for defining and registering custom taxonomies related to stories.
 * These taxonomies include genre, theme, mood, scene, and format, which provide additional
 * categorization and organization for the stories.
 */
class Story_Taxonomies {

	/**
	 * Constant taxonomies names
	 *
	 * @var string
	 */
	public const TAX_GENRE  = 'genre';
	public const TAX_THEME  = 'theme';
	public const TAX_MOOD   = 'mood';
	public const TAX_SCENE  = 'scene';
	public const TAX_FORMAT = 'format';

	/**
	 * Register the custom taxonomies.
	 */
	public function register() {
		$post_type  = Story_Post_Type::Post_Type;
		$taxonomies = array(
			array(
				'name'      => self::TAX_GENRE,
				'post_type' => array($post_type),
				'labels'    => array(
					'name'          => _x('Genres', 'taxonomy general name', 'intimate-tales'),
					'singular_name' => _x('Genre', 'taxonomy singular name', 'intimate-tales'),
				),
			),
			array(
				'name'      => self::TAX_THEME,
				'post_type' => array($post_type),
				'labels'    => array(
					'name'          => _x('Themes', 'taxonomy general name', 'intimate-tales'),
					'singular_name' => _x('Theme', 'taxonomy singular name', 'intimate-tales'),
				),
			),
			array(
				'name'      => self::TAX_MOOD,
				'post_type' => array($post_type),
				'labels'    => array(
					'name'          => _x('Moods', 'taxonomy general name', 'intimate-tales'),
					'singular_name' => _x('Mood', 'taxonomy singular name', 'intimate-tales'),
				),
			),
			// ... add more taxonomies ...
		);

		foreach ($taxonomies as $taxonomy) {
			$taxonomy_name = $taxonomy['name'];

			if (!taxonomy_exists($taxonomy_name)) {
				$default_args = array(
					'hierarchical' => true,
					'public'       => true,
					'show_ui'      => true,
					// Add other default arguments specific to this taxonomy
				);

				$args = wp_parse_args($taxonomy, $default_args);

				register_taxonomy($taxonomy_name, $taxonomy['post_type'], $args);
			}
		}
	}
}
