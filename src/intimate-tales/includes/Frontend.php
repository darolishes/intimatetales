<?php

namespace IntimateTales;

defined( 'ABSPATH' ) || exit;

use IntimateTales\Functions as Functions;

/**
 * Handles the frontend logic of the plugin.
 */
class Frontend {

	/**
	 * Initialize frontend hooks.
	 *
	 * @return void
	 */
	public function init(): void {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles_and_scripts' ) );
	}

	/**
	 * Enqueue styles and scripts for the frontend.
	 *
	 * @return void
	 */
	public function enqueue_styles_and_scripts(): void {
		wp_enqueue_style( 'intimate-tales-style', Functions::get_plugin_url() . 'assets/style.css', array(), Functions::get_plugin_version() );
		wp_enqueue_script( 'intimate-tales-script', Functions::get_plugin_url() . 'assets/script.js', array( 'jquery' ), Functions::get_plugin_version(), true );
	}
}
