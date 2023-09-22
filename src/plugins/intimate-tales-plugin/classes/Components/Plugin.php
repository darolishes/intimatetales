<?php

namespace IntimateTales\Components;

use ReflectionClass;
use ReflectionException;

/**
 * @property string path
 * @property string url
 * @property string basename
 * @version 0.1.2
 */
abstract class Plugin
{
	private ReflectionClass $ref;

	private bool $tooLateForTextdomain;
	public string $path;
	public string $url;
	public string $basename;

	/**
	 * @throws ReflectionException
	 */
	public function __construct()
	{
		$this->ref      = new ReflectionClass(get_called_class());
		$this->path     = plugin_dir_path($this->ref->getFileName());
		$this->url      = plugin_dir_url($this->ref->getFileName());
		$this->basename = plugin_basename($this->ref->getFileName());

		$this->tooLateForTextdomain = false;
		$this->on_create();
		$this->tooLateForTextdomain = true;

		register_activation_hook($this->ref->getFileName(), array($this, "on_activation"));
		register_deactivation_hook($this->ref->getFileName(), array($this, "on_deactivation"));
	}

	// -----------------------------------------------------------------------------
	// lifecycle methods
	// -----------------------------------------------------------------------------
	abstract function on_create();

	public function on_activation($networkWide)
	{
		if ($networkWide) {
			$this->foreach_multisite([$this, 'on_site_activation']);
		} else {
			$this->on_site_activation();
		}
	}

	public function on_site_activation()
	{
	}

	public function on_deactivation($networkWide)
	{
		if ($networkWide) {
			$this->foreach_multisite([$this, 'on_site_deactivation']);
		} else {
			$this->on_site_deactivation();
		}
	}

	public function on_site_deactivation()
	{
	}

	// -----------------------------------------------------------------------------
	// utility methods
	// -----------------------------------------------------------------------------
	public function load_textdomain(string $domain, string $relativeLanguagesPath)
	{
		if ($this->tooLateForTextdomain) {
			error_log("Too late: You need to setTextdomain in on_create Method of the Plugin class.");
			return;
		}
		add_action('init', function () use ($domain, $relativeLanguagesPath) {
			load_plugin_textdomain(
				$domain,
				false,
				dirname(plugin_basename($this->ref->getFileName())) . "/" . $relativeLanguagesPath
			);
		});
	}

	public function foreach_multisite(callable $onSite)
	{
		if (function_exists('is_multisite') && is_multisite()) {
			$network_site = get_network()->site_id;
			$args         = array('fields' => 'ids');
			$site_ids     = get_sites($args);

			// run the activation function for each blog id
			foreach ($site_ids as $site_id) {
				switch_to_blog($site_id);
				$onSite();
			}

			// switch back to the network site
			switch_to_blog($network_site);
		}
	}

	// -----------------------------------------------------------------------------
	// singleton pattern
	// -----------------------------------------------------------------------------
	private static $instances = [];

	public static function instance()
	{
		$class = get_called_class();
		if (!isset(self::$instances[$class])) {
			self::$instances[$class] = new static();
		}

		return self::$instances[$class];
	}
}
