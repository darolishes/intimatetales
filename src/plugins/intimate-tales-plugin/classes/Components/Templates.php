<?php
namespace IntimateTales\Components;

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

/**
 * Class Templates
 *
 * @package IntimateTales\Components
 */
class Templates
{
	protected $views;
	protected $cache = [];

	public function on_create()
	{
		$this->views = $this->plugin->path . 'views/';
	}
	
	/**
	 * @return Templates
	 */
	public static function view($slug, $args = [])
	{
		$slug = str_replace('.', '/', $slug);
		self::instance()->part($slug, null, $args);
	}

	public function part($slug, $name = null, $args = [], $subdir = '')
	{
		if ($args && is_array($args)) {
			extract($args, EXTR_SKIP);
		}

		$template = $this->find($name ? "{$slug}-{$name}.php" : "{$slug}.php", $subdir);

		if ($template) {
			include($template);
		}
	}


	public function fetch($name, $args = [], $subdir = '')
	{
		ob_start();

		$this->part(str_replace('.php', '', $name), null, $args, $subdir);

		return ob_get_clean();
	}


	public function find($name, $subdir = '')
	{
		// If the template is already in the cache, return the cache
		if (isset($this->cache[$name])) {
			return $this->cache[$name];
		}

		$path = $subdir ? $this->views . trim($subdir, '/') . '/' : $this->views;
		$dirs = [get_stylesheet_directory(), get_template_directory(), plugin_dir_path(__FILE__)];

		foreach ($dirs as $dir) {
			if (file_exists($dir . '/' . $path . $name)) {
				$this->cache[$name] = $dir . '/' . $path . $name;
				break;
			}
		}

		$this->cache[$name] = $this->cache[$name] ?? false;

		return $this->cache[$name];
	}
}
