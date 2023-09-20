<?php

namespace IntimateTales\Meta\Providers;

class DB_Provider implements Meta_Interface_Provider
{

    /**
     * Retrieve post meta field from a custom database table.
     */
    public function get_post_meta( $post_id, $key = '', $single = true ) {
        global $wpdb;

        // Beispiel-Abfrage für eine benutzerdefinierte Tabelle "custom_post_meta"
        $query = $wpdb->prepare("SELECT meta_value FROM custom_post_meta WHERE post_id = %d AND meta_key = %s", $post_id, $key);
        $result = $wpdb->get_var($query);

        return $single ? $result : [$result];  // return as array if $single is false
    }

    /**
     * Update post meta field in a custom database table.
     */
    public function update_post_meta( $post_id, $key, $value, $prev_value = '' ) {
        global $wpdb;

        // Beispiel-Abfrage zum Aktualisieren oder Einfügen in eine benutzerdefinierte Tabelle "custom_post_meta"
        $updated = $wpdb->update(
            'custom_post_meta',
            ['meta_value' => $value],
            ['post_id' => $post_id, 'meta_key' => $key]
        );

        if (false === $updated) {
            $wpdb->insert(
                'custom_post_meta',
                ['post_id' => $post_id, 'meta_key' => $key, 'meta_value' => $value]
            );
        }

        return $updated !== false;
    }

    /**
     * For the sake of simplicity, we will omit custom user meta and options for this example.
     * You can implement them similarly to the post meta methods if needed.
     */
    public function get_user_meta( $user_id, $key = '', $single = true ) {
        // Implement similar to get_post_meta if needed
    }

    public function get_option( $option, $default = true ) {
        // Implement if needed
    }
}
