<?php

namespace IntimateTales;

class Core
{
    private static $instance = null;
    public $cache;
    public $constants;
    public $integrations;

    private function __construct(Constants $constants)
    {
        $this->constants = $constants;
        $this->cache = [];
        $this->integrations = [];
    }

    public static function instance(Constants $constants): self
    {
        if (null === self::$instance) {
            self::$instance = new self($constants);
        }
        return self::$instance;
    }

    public function run(): void
    {
        register_activation_hook($this->constants::$PLUGIN_BASENAME, [$this, 'activation']);
        register_deactivation_hook($this->constants::$PLUGIN_BASENAME, [$this, 'deactivation']);

        add_action('plugins_loaded', [$this, 'text_domain']);
        add_action('wp_enqueue_scripts', [$this, 'enqueue']);

        add_filter('acf/settings/load_json', [$this, 'acf_load_json']);
        add_filter('acf/settings/save_json', [$this, 'acf_save_json']);
        add_filter('acf/json/save_paths', [$this, 'acf_save_paths'], 10, 2);
        add_filter('acf/json/save_file_name', [$this, 'acf_save_file_name'], 10, 3);
    }

    public function text_domain(): void
    {
        load_plugin_textdomain(
            $this->constants::$PLUGIN_BASENAME,
            false,
            dirname(plugin_basename($this->constants::$PLUGIN_BASENAME)) . '/languages'
        );
    }

    public function enqueue(): void
    {
        wp_enqueue_style(
            $this->constants::ENQUEUE_PREFIX . '-style',
            $this->constants::$PLUGIN_URL . '/css/style.css'
        );

        wp_enqueue_script(
            $this->constants::ENQUEUE_PREFIX . '-script',
            $this->constants::$PLUGIN_URL . '/js/script.js',
            [],
            $this->constants::VERSION,
            true
        );
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
            $result[] = $this->constants::$ACF . $path;
        }

        return $result;
    }

    public function acf_save_json($path)
    {
        return $this->constants::$ACF;
    }

    public function acf_save_paths($paths, $post)
    {
        $acf_dir = $this->constants::$ACF;

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
