<?php

namespace IntimateTales\Views;

/**
 * Asset management et al. for the front end.
 */
class PublicViews
{
	private $config;
	private $plugin_name;
	private $version;

	public function __construct($config)
	{
		$this->config = $config;
		$this->plugin_name = $this->config->get('PLUGIN_NAME');
		$this->version = $this->config->get('VERSION');
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{
		$css_url = $this->config->get('PLUGIN_URL') . 'resources/css/public.css';
		wp_enqueue_style($this->plugin_name, $css_url, array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{
		$js_url = $this->config->get('PLUGIN_URL') . 'public/js/public.js';
		wp_enqueue_script($this->plugin_name, $js_url, array('jquery'), $this->version, false);
	}
}
