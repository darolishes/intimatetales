<?php
namespace IntimateTales\Meta;

use IntimateTales\Meta\Providers\Meta_Interface_Provider;
use IntimateTales\Meta\Providers\ACF_Provider;
use IntimateTales\Meta\Providers\WP_Provider;
use IntimateTales\Meta\Providers\DB_Provider;

class Meta_Manager
{

    /**
     * The meta provider instance.
     *
     * @var Meta_Interface
     */
    private $provider;

    /**
     * Constructor to set the default provider or a given provider.
     *
     * @param string $provider_type The type of the provider ('acf', 'wordpress', 'custom_db').
     */
    public function __construct($provider_type = 'wordpress') {
        switch ($provider_type) {
            case 'acf':
                $this->provider = new ACF_Provider();
                break;

            case 'db':
                $this->provider = new DB_Provider();
                break;

            case 'wordpress':
            default:
                $this->provider = new WP_Provider();
                break;
        }
    }

    /**
     * Get post meta using the selected provider.
     */
    public function get_field($post_id, $key = '', $single = true) {
        return $this->provider->get_post_meta($post_id, $key, $single);
    }

    /**
     * Update post meta using the selected provider.
     */
    public function update_field($post_id, $key, $value, $prev_value = '') {
        return $this->provider->update_post_meta($post_id, $key, $value, $prev_value);
    }

    /**
     * Get user meta using the selected provider.
     */
    public function get_user_field($user_id, $key = '', $single = true) {
        return $this->provider->get_user_meta($user_id, $key, $single);
    }

    /**
     * Update user meta using the selected provider.
     */
    public function update_user_field($user_id, $key, $value, $prev_value = '') {
        return $this->provider->update_user_meta($user_id, $key, $value, $prev_value);
    }

    /**
     * Get term meta using the selected provider.
     */
    public function get_term_field($term_id, $key = '', $single = true) {
        return $this->provider->get_term_meta($term_id, $key, $single);
    }

    /**
     * Update term meta using the selected provider.
     */
    public function update_term_field($term_id, $key, $value, $prev_value = '') {
        return $this->provider->update_term_meta($term_id, $key, $value, $prev_value);
    }

    /**
     * Get option using the selected provider.
     */
    public function get_option($option, $default = false) {
        return $this->provider->get_option($option, $default);
    }

    /**
     * Update option using the selected provider.
     */
    public function update_option($option, $value, $prev_value = '') {
        return $this->provider->update_option($option, $value, $prev_value);
    }

    /**
     * Set the meta provider dynamically if needed.
     *
     * @param Meta_Interface $provider The meta provider instance.
     */
    public function set_provider(Meta_Interface $provider) {
        $this->provider = $provider;
    }
}
