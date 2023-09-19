<?php

namespace IntimateTales\App\Handlers;

class ACFHandler
{
    protected $acf_path;

    public function __construct($app, $acf_path)
    {
        $this->acf_path = $acf_path;
    }

    public function load_json($paths)
    {
        $additional_paths = [
            $this->acf_path . 'field-groups',
            $this->acf_path . 'post-types',
            $this->acf_path . 'option-pages',
            $this->acf_path . 'taxonomies'
        ];

        return array_merge($paths, $additional_paths);
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
            $filename = sanitize_title($post->post_title) . '.json';
        }

        return $filename;
    }

    public function fetch_dynamic_options($field_key)
    {
        $field = get_field_object($field_key);

        if ($field) {
            return $field['choices'];
        }

        return array();
    }
}
