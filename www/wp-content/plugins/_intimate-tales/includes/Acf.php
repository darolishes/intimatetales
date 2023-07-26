<?php
namespace IntimateTales;

defined('ABSPATH') || exit;

/**
 * The Acf class.
 *
 * @since 1.0.0
 */
class Acf {
    private static $instance = null;

    /**
     * Get the instance of the Acf class.
     *
     * @since 1.0.0
     * @return Acf|null The Acf instance.
     */
    public static function get_instance() {
        return self::$instance ?: (self::$instance = new self());
    }

    /**
     * Register ACF hooks and settings.
     *
     * @since 1.0.0
     */
    public function register() {
        if (!class_exists('ACF')) {
            return;
        }

        add_action('acf/init', [$this, 'register_fields']);
        add_filter('acf/settings/save_json', [$this, 'save_json']);
        add_filter('acf/settings/load_json', [$this, 'load_json']);
    }

    /**
     * Register custom ACF fields.
     *
     * @since 1.0.0
     */
    public function register_fields() {
        if (function_exists('acf_add_options_page')) {
            acf_add_options_page([
                'page_title' => 'App Options',
                'menu_title' => 'App Options',
                'menu_slug' => 'app-options',
                'capability' => 'manage_options',
                'position' => 30,
                'parent_slug' => '',
                'icon_url' => 'dashicons-admin-generic',
                'redirect' => false,
            ]);
        }
    }

    /**
     * Set the path to save ACF JSON.
     *
     * @since 1.0.0
     * @param string $path The ACF JSON save path.
     * @return string The modified save path.
     */
    public function save_json($path) {
        return INTIMATE_TALES_PLUGIN_DIR . 'acf-json';
    }

    /**
     * Add the ACF JSON load path.
     *
     * @since 1.0.0
     * @param array $paths The ACF JSON load paths.
     * @return array The modified load paths.
     */
    public function load_json($paths) {
        static $loaded = false;

        if (!$loaded) {
            unset($paths[0]);
            $paths[] = INTIMATE_TALES_PLUGIN_DIR . 'acf-json';
            $loaded = true;
        }

        return $paths;
    }

    /**
     * Get the value of a specific option.
     *
     * @since 1.0.0
     * @param string $option The option key.
     * @return mixed|null The option value.
     */
    public function get_option($option) {
        if (function_exists('get_field')) {
            return get_field($option, 'option');
        }

        return null;
    }
}
