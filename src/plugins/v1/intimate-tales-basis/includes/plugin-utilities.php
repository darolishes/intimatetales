
<?php
/**
 * Utility functions for the Intimate Tales Plugin.
 */

namespace IntimateTales;

defined('ABSPATH') || exit;

class PluginUtilities {

    /**
	 * Return the plugin dir path.
	 *
	 * @return string
	 */
	public static function get_plugin_dir(): string {
		return plugin_dir_path(INTIMATE_TALES_MAIN_FILE);
	}

	/**
	 * Return the plugin url.
	 *
	 * @return string
	 */
	public static function get_plugin_url(): string {
		return plugin_dir_url(INTIMATE_TALES_MAIN_FILE);
	}

	/**
	 * Return the plugin slug.
	 *
	 * @return string
	 */
	public static function get_plugin_slug(): string {
		return dirname(plugin_basename(INTIMATE_TALES_MAIN_FILE));
	}

	/**
	 * Return the basefile for the plugin.
	 *
	 * @return string
	 */
	public static function get_plugin_file(): string {
		return plugin_basename(INTIMATE_TALES_MAIN_FILE);
	}

	/**
	 * Return the version for the plugin.
	 *
	 * @return string
	 */
	public static function get_plugin_version(): string {
		if (!function_exists('get_plugin_data')) {
			require_once ABSPATH . 'wp-admin/includes/plugin.php';
		}
		$plugin_data = get_plugin_data(self::get_plugin_file());
		return $plugin_data['Version'];
	}

	/**
	 * Check if current user has a specific capability.
	 *
	 * @param string $capability
	 * @return bool
	 */
	public static function current_user_can(string $capability): bool {
		return current_user_can($capability);
	}

	/**
	 * Check if ACF is active.
	 *
	 * @return bool
	 */
	public static function is_acf_active(): bool {
		return class_exists('ACF');
	}

}
