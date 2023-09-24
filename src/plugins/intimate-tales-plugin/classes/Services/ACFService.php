<?php
namespace IntimateTales\Services;

use IntimateTales\Components\Component;

class ACFService extends Component 
{
    private string $acf_path;

    public function on_create(): void
    {
        $this->acf_path = dirname( $this->plugin->path ) . '/acf-json';
        $this->register_hooks();
    }

    private function register_hooks(): void
    {
        add_filter('acf/settings/save_json', [$this, 'save_json']);
        add_filter('acf/settings/load_json', [$this, 'load_json']);
        add_filter('acf/settings/save_paths', [$this, 'save_paths']);
        add_filter('acf/settings/save_file_name', [$this, 'save_file_name']);
    }

    public function load_json($paths): array
    {
        $paths = [
            'field-groups',
            'post-types',
            'option-pages',
            'taxonomies'
        ];

        return array_map(function($path) {
            return $this->acf_path . '/' . $path;
        }, $paths);
    }

    public function save_json($path): string
    {
        return $this->acf_path;
    }

    public function save_paths($paths, $post): array
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

    public function save_file_name($filename, $post, $load_path): string
    {
        if (isset($post['post_title'])) {
            $filename = str_replace([' ', '_'], '-', strtolower($post['post_title'])) . '.json';
        }

        return $filename;
    }
}