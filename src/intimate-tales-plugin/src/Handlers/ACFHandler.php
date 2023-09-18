<?php

namespace IntimateTales\Handlers;

class ACFHandler
{
    private $acf_dir;

    public function __construct()
    {
        $this->acf_dir = plugin_dir_path(__FILE__) . '/resources/acf-json';
    }

    public function acf_load_json($paths)
    {
        unset($paths[0]);

        $paths = [
            'field-groups',
            'post-types',
            'option-pages',
            'taxonomies'
        ];

        $result = [];

        foreach ($paths as $path) {
            $result[] = $this->acf_dir . $path;
        }

        return $result;
    }

    public function acf_save_json($path)
    {
        return $this->acf_dir;
    }

    public function acf_save_paths($paths, $post)
    {
        $acf_dir = $this->acf_dir;

        if (isset($post->data_storage) && $post->data_storage === 'options') {
            $paths = [$acf_dir . '/option-pages'];
        }

        if (!isset($post->key)) {
            return $paths;
        }

        if (strpos($post->key, 'group_') === 0) {
            $paths = [$acf_dir . '/field-groups'];
        }

        if (strpos($post->key, 'post_type_') === 0) {
            $paths = [$acf_dir . '/post-types'];
        }

        if (strpos($post->key, 'taxonomy_') === 0) {
            $paths = [$acf_dir . '/taxonomies'];
        }

        return $paths;
    }

    public function acf_save_file_name($filename, $post, $load_path)
    {
        if (isset($post->post_title)) {
            $filename = str_replace(
                array(' ', '_'),
                '-',
                $post->post_title
            );

            $filename = strtolower($filename) . '.json';
        }

        return $filename;
    }
}
