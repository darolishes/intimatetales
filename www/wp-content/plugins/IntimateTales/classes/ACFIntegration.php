<?php
namespace IntimateTales;

defined('ABSPATH') || exit;

class ACFIntegration
{
    public function __construct()
    {
        $this->checkACFPlugin();

        // Add filters to load and save ACF JSON
        add_filter('acf/settings/load_json', [$this, 'load_acf_json']);
        add_filter('acf/settings/save_json', [$this, 'save_acf_json']);

        // Add options page
        $this->add_options_page();
        
        // Add ACF fields and groups
        add_action('init', [$this, 'add_acf_fields']);
    }

    private function checkACFPlugin(): void
    {
        if (!class_exists('acf')) {
            throw new \Exception('ACF plugin is not active.');
        }
    }

    public function add_options_page(): void
    {
        if (!function_exists('acf_add_options_page')) {
            return;
        }

        acf_add_options_page([
            'page_title' => __('IntimateTales Options', 'intimate-tales'),
            'menu_title' => __('IntimateTales', 'intimate-tales'),
            'menu_slug' => 'intimate_tales_options',
            'capability' => 'edit_posts',
            'redirect' => false,
        ]);
    }

    public function load_acf_json($paths)
    {
        $paths[] = INTIMATE_TALES_PLUGIN_DIR . 'acf-json';
        return $paths;
    }

    public function save_acf_json($path)
    {
        $path = INTIMATE_TALES_PLUGIN_DIR . 'acf-json';
        return $path;
    }

    public function add_acf_fields(): void
    {
        // Load the ACF group data from a JSON file
        $acf_groups_data = $this->load_json_from_textfield();

        if ($acf_groups_data === null) {
            return;
        }

        foreach ($acf_groups_data as $group_key => $group_data) {
            $this->add_acf_group($group_key, $group_data);
        }
    }

    public function add_acf_group(string $group_key, array $group_data): void
    {
        if (function_exists('acf_get_field_group') && acf_get_field_group($group_key)) {
            return;
        }

        acf_add_local_field_group($group_data);
    }

    public function load_json_from_textfield(): ?array
    {
        $json_data = get_field('json_editor', 'option');

        if ($json_data === null) {
            return null;
        }

        $array_data = json_decode($json_data, true);
        return is_array($array_data) ? $array_data : null;
    }

}
