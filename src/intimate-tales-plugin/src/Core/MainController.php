<?php

namespace IntimateTales\Core;

use IntimateTales\Config;
use IntimateTales\Controllers\Loader;
use IntimateTales\Handlers\ACFHandler;

use IntimateTales\Views\Admin; // admin settings
use IntimateTales\Views\PublicViews; // views output

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    IntimateTales
 * @author     DARO <DARO>
 */
class MainController
{
	protected $loader;
	protected $config;

	public function __construct(Config $config, Loader $loader)
	{
		$this->config = $config;
		$this->loader = $loader;

		$this->loader->add_action('plugins_loaded', $this, 'load_textdomain');

		$this->define_public_hooks();
		$this->define_acf_hooks();
	}

	public function load_textdomain()
	{
		load_plugin_textdomain($this->config::TEXTDOMAIN, false, $this->config->get_plugin_path() . '/languages');
	}

	private function define_public_hooks()
	{
		$plugin_public = new PublicViews($this->config);

		$this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_styles');
		$this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_scripts');
	}

	private function define_acf_hooks()
	{
		$acf_handler = new ACFHandler($this->config->get_acf_path());

		$this->loader->add_filter('acf/settings/load_json', $acf_handler, 'load_json');
		$this->loader->add_filter('acf/settings/save_json', $acf_handler, 'save_json');
		$this->loader->add_filter('acf/json/save_paths', $acf_handler, 'save_paths');
		$this->loader->add_filter('acf/json/save_file_name', $acf_handler, 'save_file_name');
	}

	public function run()
	{
		$this->loader->run();
	}

	public function get_loader()
	{
		return $this->loader;
	}
}
