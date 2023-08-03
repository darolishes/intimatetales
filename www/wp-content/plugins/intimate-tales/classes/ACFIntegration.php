<?php

namespace IntimateTales;

defined('ABSPATH') || exit;

class ACFIntegration
{
    private array $choicesSettings = [];
    private bool $acfFieldsAdded = false;

    public function __construct()
    {
        if (!class_exists('acf')) {
            throw new \Exception('ACF plugin is not active.');
        }

        // Add options page
        $this->add_options_page();

        // Add filters to load and save ACF JSON
        add_filter('acf/settings/load_json', fn($paths) => array_merge($paths, [INTIMATE_TALES_PLUGIN_DIR . 'acf-json']));
        add_filter('acf/settings/save_json', fn($path) => INTIMATE_TALES_PLUGIN_DIR . 'acf-json');

        // Add ACF fields and groups when needed
        add_action('acf/init', [$this, 'add_acf_fields_on_demand']);
    }

    public function add_options_page(): void
    {
        if (!function_exists('acf_add_options_page')) {
            return;
        }

        acf_add_options_page([
            'page_title' => 'IntimateTales Options',
            'menu_title' => 'IntimateTales',
            'menu_slug' => 'intimate_tales_options',
            'capability' => 'edit_posts',
            'redirect' => false,
        ]);
    }

    public function add_acf_fields_on_demand(): void
    {
        // Only add ACF fields and groups once
        if (!$this->acfFieldsAdded) {
            $this->acfFieldsAdded = true;
            $this->add_acf_fields();
        }
    }

    public function add_acf_fields(): void
    {
        $json_file = INTIMATE_TALES_PLUGIN_DIR . 'acf-json/group_app_options.json';
        if (file_exists($json_file)) {
            $json_data = file_get_contents($json_file);
            $acf_groups_data = json_decode($json_data, true);

            foreach ($acf_groups_data as $group_key => $group_data) {
                if (is_array($group_data)) {
                    $this->add_acf_group($group_key, $group_data);
                }
            }
        }
    }

    public function add_acf_group(string $group_key, array $group_data): void
    {
        if (function_exists('acf_get_field_group') && acf_get_field_group($group_key)) {
            return;
        }

        $group_data['key'] = $group_key;
        $group_data['location'] = [[['param' => 'options_page', 'operator' => '==', 'value' => 'intimate_tales_options']]];

        acf_add_local_field_group($group_data);
    }

    public function add_choices_setting(string $key, array $choices): void
    {
        $this->choicesSettings[$key] = $choices;

        // Update the default values of the repeater fields in the ACF options page
        $options_page = get_page_by_path('intimate_tales_options', OBJECT, 'acf-field-group');
        if ($options_page) {
            update_field($key, $choices, $options_page->ID);
        }
    }
}
