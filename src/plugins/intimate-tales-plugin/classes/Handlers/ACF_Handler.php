<?php

namespace IntimateTales\Handlers;

use IntimateTales\Components\Component;

/**
 * Class ACFHandler
 * @package IntimateTales\Handlers
 * @author Dawid Rogaczewski
 * @version 1.0.0
 */
class ACF_Handler extends Component
{
    private $acf_path;

    public function onCreate()
    {
        $this->acf_path = dirname( $this->plugin->path ) . '/acf-json';

        add_filter('acf/settings/save_json', [$this, 'save_json']);
        add_filter('acf/settings/load_json', [$this, 'load_json']);
        add_filter('acf/settings/save_paths', [$this, 'save_paths']);
        add_filter('acf/settings/save_file_name', [$this, 'save_file_name']);
    }

    public function load_json($paths)
    {
        $paths = [
            'field-groups',
            'post-types',
            'option-pages',
            'taxonomies'
        ];

        $result = array_map(function($path) {
            return $this->acf_path . '/' . $path;
        }, $paths);

        return $result;
    }

    public function save_json($path)
    {
        return $this->acf_path;
    }

    public function save_paths($paths, $post)
    {
        $acf_path = $this->acf_path;

        if (isset($post['data_storage']) && $post['data_storage'] === 'options') {
            $paths = [$acf_path . '/option-pages'];
        }

        if (!isset($post['key'])) {
            return $paths;
        }

        $prefixes = [
            'group_' => '/field-groups',
            'post_type_' => '/post-types',
            'taxonomy_' => '/taxonomies'
        ];

        foreach ($prefixes as $prefix => $path) {
            if (strpos($post['key'], $prefix) === 0) {
                $paths = [$acf_path . $path];
                break;
            }
        }

        return $paths;
    }

    public function save_file_name($filename, $post, $load_path)
    {
        if (isset($post['post_title'])) {
            $filename = str_replace([' ', '_'], '-', strtolower($post['post_title'])) . '.json';
        }

        return $filename;
    }
}
