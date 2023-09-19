<?php

namespace App\Providers;

use Roots\WPConfig\Config;
use Illuminate\Support\ServiceProvider;

class ACFServiceProvider extends ServiceProvider
{
    protected $acf_path;

    public function register(): void
    {
        $this->acf_path = config('app.custom.acf_path');
    }

    public function boot(): void
    {
        add_filter('acf/settings/load_json', [$this, 'load_json']);
        add_filter('acf/settings/save_json', [$this, 'save_json']);
        add_filter('acf/json/save_paths', [$this, 'save_paths'], 10, 2);
        add_filter('acf/json/save_file_name', [$this, 'save_file_name'], 10, 3);
    }

    public function load_json($paths)
    {
        $sub_dirs = ['field-groups', 'post-types', 'option-pages', 'taxonomies'];
        $additional_paths = array_map(fn($sub_dir) => $this->acf_path . $sub_dir, $sub_dirs);

        return array_merge($paths, $additional_paths);
    }

    public function save_json($path)
    {
        return $this->acf_path;
    }

    public function save_paths($paths, $post)
    {
        $acf_path = $this->acf_path;
        $paths_map = [
            'options' => '/option-pages',
            'group_' => '/field-groups',
            'post_type_' => '/post-types',
            'taxonomy_' => '/taxonomies'
        ];

        foreach ($paths_map as $key => $path) {
            if (isset($post['data_storage']) && $post['data_storage'] === $key || strpos($post['key'] ?? '', $key) === 0) {
                return [$acf_path . $path];
            }
        }

        return $paths;
    }

    public function save_file_name($filename, $post, $load_path)
    {
        if (isset($post['title'])) {
            $filename = str_replace(
                array(' ', '_'),
                '-',
                $post['title']
            );

            $filename = strtolower($filename) . '.json';
        }
        
        return $filename;
    }

    public function fetch_dynamic_options($field_key)
    {
        $field = get_field_object($field_key);
        return $field ? $field['choices'] : [];
    }
}