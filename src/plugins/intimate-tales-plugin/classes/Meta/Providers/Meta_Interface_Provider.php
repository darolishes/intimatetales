<?php

namespace IntimateTales\Meta\Providers;

interface Meta_Interface_Provider
{

    /**
     * Retrieve post meta field for a post.
     *
     * @param int    $post_id Post ID.
     * @param string $key     Optional. The meta key to retrieve. By default, returns data for all keys.
     * @param bool   $single  Optional. Whether to return a single value. Default false.
     * @return mixed Will be an array if $single is false. Will be value of meta data field if $single is true.
     */
    public function get_post_meta( $post_id, $key = '', $single = true );

    /**
     * Update post meta field based on post ID.
     *
     * @param int    $post_id    Post ID.
     * @param string $meta_key   Metadata key.
     * @param mixed  $meta_value Metadata value.
     * @return int|bool Meta ID if the key didn't exist, true on successful update, false on failure.
     */
    public function update_post_meta($post_id, $meta_key, $meta_value);

    /**
     * Retrieve user meta field for a user.
     *
     * @param int    $user_id User ID.
     * @param string $key     Optional. The meta key to retrieve. By default, returns data for all keys. Default empty.
     * @param bool   $single  Optional. Whether to return a single value. Default false.
     * @return mixed Will be an array if $single is false, the value of the meta field if $single is true.
     */
    public function get_user_meta($user_id, $key = '', $single = true);

    /**
     * Update user meta field based on user ID.
     *
     * @param int    $user_id    User ID.
     * @param string $meta_key   Metadata key.
     * @param mixed  $meta_value Metadata value.
     * @return int|bool Meta ID if the key didn't exist, true on successful update, false on failure.
     */
    public function update_user_meta($user_id, $meta_key, $meta_value);

    /**
     * Retrieve option value based on its name.
     *
     * @param string $option   Option name.
     * @param mixed  $default  Default value to return if the option does not exist.
     * @return mixed Value set for the option.
     */
    public function get_option($option, $default = false);

    /**
     * Update option value based on its name.
     *
     * @param string $option   Option name.
     * @param mixed  $value    Value to set for the option.
     * @return bool True if option value has changed, false if not or if update failed.
     */
    public function update_option($option, $value);

    /**
     * Get term meta field for a term.
     *
     * @param int    $term_id Term ID.
     * @param string $key     Optional. The meta key to retrieve.
     * @param bool   $single  Optional. Whether to return a single value. Default false.
     * @return mixed Will be an array if $single is false, the value of the meta field if $single is false, the value of the meta field if
     */
    public function get_term_meta($term_id, $key, $single = true);

    /**
     * Update term meta field based on term ID.
     * 
     * @param int $term_id Term ID.
     * @param string $key Metadata key.
     * @param mixed $value Metadata value.
     * @param bool $single Optional. Whether to return a single value. Default false.
     * @return bool True if the key didn't exist, true on successful update, false on failure.
     */
    public function update_term_meta($term_id, $key, $value);

    /**
     * Retrieve settings related to the meta provider.
     *
     * @return array Settings data.
     */
    public function get_settings();
}