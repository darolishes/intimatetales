<?php

/**
 * IntimateTales Main Class
 *
 * This class initializes and manages the core functionalities of the IntimateTales Plugin.
 * It handles the loading of other classes, and the main processes related to the plugin.
 *
 * @package IntimateTalesPlugin
 * @subpackage Main
 */

// Prevent direct access to the file
if (!defined('ABSPATH')) {
	die('Direct script access denied.');
}

class IntimateTales {

	/**
	 * Constructor function.
	 * This function will set up hooks, actions, and filters for the plugin.
	 */
	public function __construct() {
		// Load the plugin text domain for internationalization
		add_action('plugins_loaded', array($this, 'load_textdomain'));

		// Enqueue scripts and styles
		add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts_and_styles'));
	}

	/**
	 * Function that runs on plugin activation.
	 * This function will set up any necessary database tables, default settings, etc.
	 */
	public function on_activation() {
		// Set default settings, create tables, etc.

		// Ensure the acf-json directory exists
		$acf_json_path = IT_ACF_PATH;
		if (!is_dir($acf_json_path)) {
			mkdir($acf_json_path, 0755, true);
		}
	}

	/**
	 * Function that runs on plugin deactivation.
	 * This function will handle any necessary cleanup (if any).
	 */
	public function on_deactivation() {
		// Cleanup, remove temporary data, etc.
		// E.g., remove custom roles, clear cached data, etc.
	}

	/**
	 * Load the plugin text domain for internationalization.
	 */
	public function load_textdomain() {
		load_plugin_textdomain(IT_TEXTDOMAIN, false, dirname(plugin_basename(__FILE__)) . '/languages/');
	}

	/**
	 * Enqueue scripts and styles related to the plugin.
	 */
	public function enqueue_scripts_and_styles() {
		// Example: Enqueue a stylesheet
		// wp_enqueue_style(IT_ENQUEUE_PREFIX . 'style', IT_PLUGIN_URL . 'assets/css/style.css', array(), IT_VERSION, 'all');

		// Example: Enqueue a JavaScript file
		// wp_enqueue_script(IT_ENQUEUE_PREFIX . 'script', IT_PLUGIN_URL . 'assets/js/script.js', array('jquery'), IT_VERSION, true);
	}

	/**
	 * Main run function for the plugin.
	 * This function will initialize other components and start the plugin's main functionalities.
	 */
	public function run() {
		register_activation_hook(__FILE__, [$this, 'on_activation']);
		register_deactivation_hook(__FILE__, [$this, 'on_deactivation']);

		add_action('acf/settings/load_json', [$this, 'acf_set_local_json_load_point']);
		add_action('acf/settings/save_json', [$this, 'acf_set_local_json_save_point']);
		add_filter('acf/json/save_paths', [$this, 'acf_modify_json_save_paths']);
		add_filter('acf/json/file_name', [$this, 'acf_modify_json_file_name'], 10, 3);
	}

	/**
	 * Set the load point for ACF Local JSON.
	 *
	 * @param array $paths The existing paths where ACF should look for Local JSON config.
	 * @return array The modified paths.
	 */
	public function acf_set_local_json_load_point($paths) {
		// Remove the original path (optional)
		unset($paths[0]);

		// Append our new path
		$paths[] = IT_ACF_PATH;

		return $paths;
	}

	/**
	 * Set the save point for ACF Local JSON.
	 *
	 * @param string $path The existing save path.
	 * @return string The modified save path.
	 */
	public function acf_set_local_json_save_point($path) {
		return IT_ACF_PATH;
	}

	/**
	 * Set the save paths for ACF Local JSON based on the post data.
	 *
	 * @param array $paths The default paths.
	 * @param WP_Post $post The post object being saved.
	 * @return array Modified paths.
	 */
	public function acf_modify_json_save_paths($paths, $post) {
		$acf_dir = IT_ACF_PATH;

		if (isset($post['data_storage']) && $post['data_storage'] === 'options') {
			$paths = [$acf_dir . '/option-pages'];
		}

		if (isset($post['title'])) {
			if ($post['title'] === 'App Settings Fields') {
				$paths = [$acf_dir . '/field-groups'];
			}

			if ($post['title'] === 'Post Type Story') {
				$paths = [$acf_dir . '/post-types'];
			}
		}

		return $paths;
	}

	/**
	 * Modify the filename for ACF Local JSON based on the post title.
	 *
	 * @param string $filename The default filename.
	 * @param WP_Post $post The post object being saved.
	 * @param string $load_path The path where the JSON file will be loaded.
	 * @return string Modified filename.
	 */
	public function acf_modify_json_file_name($filename, $post, $load_path) {
		if (isset($post['title'])) {
			$filename = str_replace(
				array(' ', '_'),
				'-',
				$post['title']
			);

			$filename = strtolower($filename) . '.json';
		}

		return $filename;
	}
}
