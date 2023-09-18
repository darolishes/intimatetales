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

    /**
     * Fetches the dynamic options for user preferences.
     *
     * @param string $field_key The key of the field.
     * @return array The options for the field.
     */
    public function fetch_dynamic_options($field_key)
    {
        $field = get_field_object($field_key);

        if ($field) {
            return $field['choices'];
        }

        return array();
    }

    /**
     * Fetches the dynamic options for interests configuration.
     *
     * @return array The options for interests configuration.
     */
    public function fetch_interests_configuration()
    {
        return $this->fetch_dynamic_options('interests_configuration');
    }

    /**
     * Fetches the dynamic options for roleplay preferences.
     *
     * @return array The options for roleplay preferences.
     */
    public function fetch_roleplay_preferences()
    {
        return $this->fetch_dynamic_options('roleplay_preferences');
    }
}
