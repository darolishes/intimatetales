<?php

namespace IntimateTales;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

defined( 'ABSPATH' ) || exit;

class Template_Loader {

	/**
	 * @var Environment
	 */
	public function __construct() {
		// Set up the Twig environment
		$loader     = new FilesystemLoader( plugin_dir_path( __FILE__ ) . 'templates/' );
		$this->twig = new Environment( $loader );
	}

	public function load_template( $template_name, $data = array() ) {
		// Check if the .html.twig version of the template exists
		$template_path = plugin_dir_path( __FILE__ ) . "templates/{$template_name}.html.twig";
		if ( file_exists( $template_path ) ) {
			echo $this->twig->render( "{$template_name}.html.twig", $data );
			return;
		}

		// Fallback to .php template if no .html.twig version exists
		$template_path = plugin_dir_path( __FILE__ ) . "templates/{$template_name}.php";
		if ( file_exists( $template_path ) ) {
			include $template_path;
		} else {
			_doing_it_wrong( __FUNCTION__, sprintf( '<code>%s</code> does not exist.', $template_name ), '1.0.0' );
		}
	}
}
