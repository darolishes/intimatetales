<?php

namespace IntimateTales\Meta\Providers;

class ACF_Provider implements Meta_Interface_Provider
{
    /**
     * Retrieve post meta field for a post using ACF's get_field function.
     */
    public function get_post_meta($post_id, $key = '', $format_value = true) {
        return get_field($key, $post_id, $format_value);
    }

    /**
     * Update a post meta field for a post using ACF's update_field function.
     */
    public function update_post_meta($post_id, $key, $value) {
        return update_field($key, $value, $post_id);
    }

    /**
     * Retrieve user meta field for a user using ACF's get_field function.
     */
    public function get_user_meta($user_id, $key = '', $format_value = true) {
        return get_field($key, 'user_' . $user_id, $format_value);
    }

    /**
     * Update a user meta field for a user using ACF's update_field function.
     */
    public function update_user_meta($user_id, $key, $value) {
        return update_field($key, $value, 'user_'. $user_id);
    }

    /**
     * Get term meta field for a term using ACF's get_field function.
     */
    public function get_term_meta($term_id, $key = '', $format_value = true) {
        return get_field($key, 'term_' . $term_id, $format_value);
    }

    /**
     * Update a term meta field for a term using ACF's update_field function.
     */
    public function update_term_meta($term_id, $key, $value) {
        return update_field($key, $value, 'term_'. $term_id);
    }

    /**
     * Retrieve option value using ACF's get_field() function.
     */
    public function get_option( $option, $default = false ) {
        // ACF's get_field() for options doesn't require a post ID, but uses the 'option' keyword
        $value = get_field( $option, 'option' );
        return $value !== null ? $value : $default;
    }

    /**
     * Update option value using ACF's update_field() function.
     */
    public function update_option( $option, $value ) {
        return update_field( $option, $value, 'option' );
    }
}
