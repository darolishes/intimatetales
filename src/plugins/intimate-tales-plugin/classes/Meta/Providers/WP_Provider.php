<?php

namespace IntimateTales\Meta\Providers;

class WP_Provider implements Meta_Interface_Provider
{

    public function get_post_meta($post_id, $key = '', $single = true) 
    {
        return \get_post_meta($post_id, $key, $single);
    }

    public function update_post_meta($post_id, $meta_key, $meta_value) 
    {
        return \update_post_meta($post_id, $meta_key, $meta_value);
    }

    public function get_user_meta($user_id, $key = '', $single = true) 
    {
        return \get_user_meta($user_id, $key, $single);
    }

    public function update_user_meta($user_id, $meta_key, $meta_value) 
    {
        return \update_user_meta($user_id, $meta_key, $meta_value);
    }

    public function get_option($option, $default = false) 
    {
        return \get_option($option, $default);
    }

    public function update_option($option, $value) 
    {
        return \update_option($option, $value);
    }

    public function get_term_meta($term_id, $key = '', $single = true) 
    {
        return \get_term_meta($term_id, $key, $single);
    }

    public function update_term_meta($term_id, $key, $value) 
    {
        return \update_term_meta($term_id, $key, $value);
    }

    public function get_settings() 
    {
        // For this provider, we may not have a separate settings array.
        // You can modify this method based on your specific needs.
        return [];
    }
}
