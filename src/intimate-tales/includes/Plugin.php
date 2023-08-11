<?php

namespace IntimateTales;

defined('ABSPATH') || exit;

use IntimateTales\Admin;
use IntimateTales\Frontend;
use IntimateTales\Functions;
use IntimateTales\Models\Story\Story;
use IntimateTales\Models\Story\Story_Post_Type;
use IntimateTales\Models\Story\Story_Taxonomies;

/**
 * IntimateTales class.
 */
class Plugin {

	private $frontend;
	private $admin;

	public function __construct() {
		$this->frontend = new Frontend();
		$this->admin = new Admin();

		add_action('plugins_loaded', [$this, 'loaded']);
	}

	/**
	 * Initialize plugin functionalities.
	 */
	public function initialized() {
		// Load plugin textdomain for translations
		load_plugin_textdomain(
			'intimate-tales',
			false,
			Functions::get_plugin_dir() . '/languages'
		);

		// Register story post type and taxonomies
		$story_post_type = new Story_Post_Type();
		$story_post_type->register();

		$story_taxonomies = new Story_Taxonomies();
		$story_taxonomies->register();
	}

	/**
	 * Functionality to run after all plugins are loaded.
	 */
	public function loaded() {
		add_action('init', [$this, 'initialized']);
		add_action('admin_init', [$this->admin, 'admin_init']);
	}
}
