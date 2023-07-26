<?php
namespace IntimateTales\Classes;

class Authentication {
    private static $instance;

    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct() {
        // Initialize the Authentication class here
    }

    public function wordpress_authenticate($username, $password) {
        // Validate inputs
        if (empty($username) || empty($password)) {
            return new \WP_Error('empty_field', 'Username or password cannot be empty');
        }

        // Use WordPress core functions for authentication
        $user = wp_authenticate($username, $password);

        if (is_wp_error($user)) {
            // Authentication failed
            return $user;  // Return the WP_Error object for more specific error handling
        }

        // Authentication successful
        return true;
    }

    public function third_party_authenticate($username, $password) {
        // Validate inputs
        if (empty($username) || empty($password)) {
            return new \WP_Error('empty_field', 'Username or password cannot be empty');
        }

        // Implement third-party authentication logic here
        // You may use APIs or libraries to authenticate the user against an external service
        // For the sake of this example, let's assume the authentication is successful
        return true;
    }
}
