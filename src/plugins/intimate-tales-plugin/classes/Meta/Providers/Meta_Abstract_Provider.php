<?php

namespace IntimateTales\Meta\Providers;

abstract class Meta_Abstract_Provider implements Meta_Interface_Provider
{
    /**
     * Retrieve post meta field for a post.
     *
     * @param int    $post_id Post ID.
     * @param string $key     Optional. The meta key to retrieve. Default empty.
     * @param bool   $single  Optional. Whether to return a single value. Default true.
     * @return mixed Will be an array if $single is false, the value of the meta field if $single is true.
     */
    abstract public function get_post_meta($post_id, $key = '', $single = true);

    /**
     * Update post meta field based on post ID.
     *
     * @param int    $post_id    Post ID.
     * @param string $meta_key   Metadata key.
     * @param mixed  $meta_value Metadata value.
     * @return int|bool Meta ID if the key didn't exist, true on successful update, false on failure.
     */
    abstract public function update_post_meta($post_id, $meta_key, $meta_value);

    /**
     * Retrieve user meta field for a user.
     *
     * @param int    $user_id User ID.
     * @param string $key     Optional. The meta key to retrieve. Default empty.
     * @param bool   $single  Optional. Whether to return a single value. Default true.
     * @return mixed Will be an array if $single is false, the value of the meta field if $single is true.
     */
    abstract public function get_user_meta($user_id, $key = '', $single = true);

    /**
     * Update user meta field for a user.
     *
     * @param int    $user_id User ID.
     * @param string $key     The meta key to update.
     * @param mixed  $value   The new value of the meta field.
     * @return bool True on success, false on failure.
     * @since 1.0.0
     */
    abstract public function update_user_meta( $user_id, $key, $value );

    /**
     * Delete user meta field for a user.
     * 
     * @param int    $user_id User ID.
     * @param string $key The meta key to delete.
     * @return bool True on success, false on failure.
     * @since 1.0.0
     */
    abstract public function delete_user_meta( $user_id, $key );

    /**
     * Retrieve term meta field for a term.
     *
     * @param int    $term_id Term ID.
     * @param string $key     Optional. The meta key to retrieve. Default empty.
     * @param bool   $single  Optional. Whether to return a single value. Default true.
     * @return mixed Will be an array if $single is false, the value of the meta field if $single is true.
     * @since 1.0.0
     */
    abstract public function get_term_meta( $term_id, $key = '', $single = true );

    /**
     * Update term meta field for a term.
     *
     * @param int    $term_id Term ID.
     * @param string $key     The meta key to update.
     * @param mixed  $value   The new value of the meta field.
     * @return bool True on success, false on failure.
     * @since 1.0.0
     */
    abstract public function update_term_meta( $term_id, $key, $value );

    /**
     * Retrieve settings related to the meta provider.
     *
     * @return array Settings data.
     */
    public function get_settings()
    {
        // This method should be overridden by child classes.
        return [];
    }
}