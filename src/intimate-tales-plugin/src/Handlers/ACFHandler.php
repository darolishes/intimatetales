<?php

namespace IntimateTales\Handlers;

class ACFHandler
{
    private $acf_path;

    public function __construct($acf_path)
    {
        $this->acf_path = $acf_path;
    }

    public function load_json($paths)
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
            $result[] = $this->acf_path . $path;
        }

        return $result;
    }

    public function save_json($path)
    {
        return $this->acf_path;
    }

    public function save_paths($paths, $post)
    {
        $acf_path = $this->acf_path;

        if (isset($post->data_storage) && $post->data_storage === 'options') {
            $paths = [$acf_path . '/option-pages'];
        }

        if (!isset($post->key)) {
            return $paths;
        }

        if (strpos($post->key, 'group_') === 0) {
            $paths = [$acf_path . '/field-groups'];
        }

        if (strpos($post->key, 'post_type_') === 0) {
            $paths = [$acf_path . '/post-types'];
        }

        if (strpos($post->key, 'taxonomy_') === 0) {
            $paths = [$acf_path . '/taxonomies'];
        }

        return $paths;
    }

    public function save_file_name($filename, $post, $load_path)
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
