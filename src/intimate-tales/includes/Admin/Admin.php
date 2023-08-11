<?php

namespace IntimateTales\Admin;

class Admin {
	const PLUGIN_DIR = INTIMATE_TALES_DIR_PATH;

	public function __construct() {
		$this->validate_acf();
		#$this->add_options_page();
		add_action('admin_init', [$this, 'admin_init']);
		add_filter('acf/settings/load_json', [$this, 'load_paths']);
		add_filter('acf/json/save_paths', [$this, 'save_paths'], 10, 2);
		add_filter('acf/json/save_file_name', [$this, 'save_file_name'], 10, 3);
	}

	public function admin_init() {
	}

	private function add_options_page() {
		add_action('acf/init', function () {
			acf_add_options_page([
				'page_title' => 'Theme Settings',
				'menu_title' => 'Theme Settings',
				'menu_slug'  => 'intimate-tales',
				'capability' => 'edit_posts',
				'redirect'   => false
			]);

			acf_add_options_sub_page([
				'page_title'    => 'Design Settings',
				'menu_title'    => 'Design',
				'parent_slug'   => 'theme-settings'
			]);

			acf_add_options_sub_page([
				'page_title'    => 'Interaction Settings',
				'menu_title'    => 'Interaction',
				'parent_slug'   => 'theme-settings'
			]);

			acf_add_options_sub_page([
				'page_title'    => 'Payment Settings',
				'menu_title'    => 'Payment',
				'parent_slug'   => 'theme-settings'
			]);

			acf_add_options_sub_page([
				'page_title'    => 'User Settings',
				'menu_title'    => 'User',
				'parent_slug'   => 'theme-settings'
			]);
		});
	}

	public function load_paths($paths) {
		$paths[] = self::PLUGIN_DIR . '/acf-json/post-types';
		$paths[] = self::PLUGIN_DIR . '/acf-json/field-groups';
		$paths[] = self::PLUGIN_DIR . '/acf-json/taxonomies';
		$paths[] = self::PLUGIN_DIR . '/acf-json/option-pages';

		return $paths;
	}

	public function save_paths($paths, $post) {
		$plugin_dir = self::PLUGIN_DIR . '/acf-json';

		if ($post['data_storage'] === 'options') {
			$paths = [$plugin_dir . '/option-pages'];
		}

		if ($post['title'] === 'App Settings Fields') {
			$paths = [$plugin_dir . '/field-groups'];
		}

		return $paths;
	}

	public function save_file_name($filename, $post, $load_path) {
		$filename = str_replace(
			array(
				' ',
				'_',
			),
			array(
				'-',
				'-'
			),
			$post['title']
		);

		$filename = strtolower($filename) . '.json';

		return $filename;
	}

	public function validate_acf() {
		if (!class_exists('acf')) {
			throw new \Exception('ACF not installed');
		}
	}
}
