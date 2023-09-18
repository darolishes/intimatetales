<?php

namespace IntimateTales\Core;

use IntimateTales\Config;
use IntimateTales\Controllers\Loader; // All actions and filters
use IntimateTales\Internalization\I18n; // language
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

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct()
	{

		$this->loader = new Loader();
		$this->loader->add_action('plugins_loaded', $this, 'load_textdomain');

		$this->define_admin_hooks();
		$this->define_public_hooks();
		$this->define_acf_hooks();
	}

	private function load_textdomain()
	{
		$text_domain = Config::TEXTDOMAIN;
		$plugin_path = Config::get_plugin_path();

		load_plugin_textdomain($text_domain, false, $plugin_path . '/languages');
	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks()
	{

		$plugin_admin = new Admin();

		$this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles');
		$this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks()
	{
		$plugin_public = new PublicViews();

		$this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_styles');
		$this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_scripts');
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 */
	private function define_acf_hooks()
	{
		$plugin_acf = new ACF();

		$this->loader->add_action('acf/include_fields', $plugin_acf, 'include_fields');
		$this->loader->add_action('acf/include_fields', $plugin_acf, 'include_fields_admin');
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run()
	{
		$this->loader->run();
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader()
	{
		return $this->loader;
	}
}
