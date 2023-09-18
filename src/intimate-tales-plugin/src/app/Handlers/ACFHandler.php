<?php

namespace IntimateTales\App\Handlers;

use Roots\WPConfig\Config;

class ACFHandler
{
    private $acf_path;

    public function __construct($acf_path)
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
        // ... (rest of the method remains unchanged)
    }

    public function save_file_name($filename, $post, $load_path)
    {
        if (isset($post->post_title)) {
            $filename = sanitize_title($post->post_title) . '.json';
        }

        return $filename;
    }

    // ... (rest of the class remains unchanged)
}
