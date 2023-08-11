<?php

namespace IntimateTales;

defined( 'ABSPATH' ) || exit;

/**
 * Handles the backend/admin logic of the plugin.
 */
class Admin {

	/**
	 * Initialize backend hooks.
	 *
	 * @return void
	 */
	public function admin_init(): void {
		// Check if ACF is active
		if ( ! class_exists( 'ACF' ) ) {
			add_action( 'admin_notices', array( $this, 'acf_dependency_notice' ) );
			return;
		}

		add_filter( 'acf/settings/load_json', array( $this, 'acf_load_json' ) );
		add_filter( 'acf/settings/save_json', array( $this, 'acf_save_json' ) );
	}

	/**
	 * Show a notice if ACF is not active.
	 *
	 * @return void
	 */
	public function acf_dependency_notice(): void {
		echo '<div class="notice notice-error"><p><strong>IntimateTales</strong> requires the Advanced Custom Fields (ACF) plugin to be installed and active.</p></div>';
	}

	/**
	 * Define where to save ACF field group JSON files.
	 *
	 * @return string
	 */
	public function acf_save_json(): string {
		return Functions::get_plugin_dir_path() . 'acf-json';
	}

	/**
	 * Load ACF field group JSON files.
	 *
	 * @param array $paths Paths to load JSON.
	 * @return array
	 */
	public function acf_load_json( array $paths ): array {
		unset( $paths[0] );
		$paths[] = Functions::get_plugin_dir_path() . 'acf-json';
		return $paths;
	}

	/**
	 * Retrieve an ACF option value.
	 *
	 * @param string $option_name
	 * @return mixed
	 */
	public function get_acf_option( string $option_name ) {
		return get_field( $option_name, 'option' );
	}

	/**
	 * Set an ACF option value.
	 *
	 * @param string $option_name
	 * @param mixed  $value
	 * @return void
	 */
	public function update_acf_option( string $option_name, $value ): void {
		update_field( $option_name, $value, 'option' );
	}
}
