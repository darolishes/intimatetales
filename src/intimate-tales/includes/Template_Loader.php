<?php

namespace IntimateTales;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

defined('ABSPATH') || exit;

class Template_Loader {

	/**
	 * @var Environment
	 */
	private $twig;

	/**
	 * @var string
	 */
	private $template_path;

	public function __construct() {
		$this->template_path = plugin_dir_path(__FILE__) . 'templates/';

		// Set up the Twig environment
		$loader = new FilesystemLoader($this->template_path);
		$this->twig = new Environment($loader);
	}

	public function load_template($template_name, $data = array()) {
		// Check if the .twig version of the template exists
		if (file_exists($this->template_path . "{$template_name}.twig")) {
			echo $this->twig->render("{$template_name}.twig", $data);
			return;
		}

		// Check if the .html.twig version of the template exists
		if (file_exists($this->template_path . "{$template_name}.html.twig")) {
			echo $this->twig->render("{$template_name}.html.twig", $data);
			return;
		}

		// Fallback to .php template if no .html.twig version exists
		if (file_exists($this->template_path . "{$template_name}.php")) {
			include $this->template_path . "{$template_name}.php";
		} else {
			_doing_it_wrong(__FUNCTION__, sprintf('<code>%s</code> does not exist.', $template_name), '1.0.0');
		}
	}
}
