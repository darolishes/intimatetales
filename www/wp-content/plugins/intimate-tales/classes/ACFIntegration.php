<?php
namespace IntimateTales;

defined('ABSPATH') || exit;

/**
 * Class ACFIntegration
 */
class ACFIntegration
{
    /**
     * Constructor function.
     */
    public function __construct()
    {
        add_action('acf/init', [$this, 'add_acf_fields'], 10);
    }

    /**
     * Add the ACF fields.
     */
    public function add_acf_fields()
    {
        // Register ACF groups from JSON files
        $acf_groups = [
            'group_app_options' => 'App Options',
            'group_story_category' => 'Story Category',
            'group_story' => 'Story',
            'group_user_meta' => 'User Meta',
            'group_user_preferences' => 'User Preferences',
        ];

        foreach ($acf_groups as $group_key => $group_title) {
            $json_file = INTIMATE_TALES_PLUGIN_DIR . 'acf-json/' . $group_key . '.json';
            if (file_exists($json_file)) {
                $json_data = json_decode(file_get_contents($json_file), true);
                if (!empty($json_data) && is_array($json_data)) {
                    $this->register_acf_group($json_data);
                }
            }
        }
    }

    /**
     * Register ACF group using JSON data.
     *
     * @param array $group_data JSON data for the ACF group.
     */
    private function register_acf_group($group_data)
    {
        if (!function_exists('acf_add_local_field_group')) {
            return;
        }

        // Ensure key and title are set in the group data
        if (!isset($group_data['key']) || !isset($group_data['title'])) {
            return;
        }

        acf_add_local_field_group($group_data);
    }

    /**
     * Get the app options from the ACF options page.
     *
     * @return array|bool An array of app options on success, false on failure.
     */
    public function get_app_options()
    {
        if (!function_exists('acf_get_options_page')) {
            return false;
        }

        $options_page = acf_get_options_page('app-options');

        if (!$options_page) {
            return false;
        }

        $app_options = get_field('general_settings', $options_page['ID']);

        if (empty($app_options)) {
            return false;
        }

        return $app_options;
    }
}
