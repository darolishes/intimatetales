<?php
/**
 * User management functions for IntimateTales WordPress plugin.
 */

// Ensure WordPress environment
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Register a new user.
 *
 * @param array $user_data User data.
 * @return int|WP_Error User ID on success, WP_Error on failure.
 */
function intimatetales_register_user( $user_data ) {
    $username = $user_data['username'];
    $email = $user_data['email'];
    $password = $user_data['password'];

    // Validate and sanitize input data
    $username = sanitize_user( $username );
    $email = sanitize_email( $email );
    $password = esc_attr( $password );

    if ( username_exists( $username ) || email_exists( $email ) ) {
        return new WP_Error( 'user_exists', 'User already exists' );
    }

    // Create the user
    $user_id = wp_create_user( $username, $password, $email );
    if ( is_wp_error( $user_id ) ) {
        return $user_id;
    }

    // Set user role or additional meta data here if needed

    return $user_id;
}

/**
 * Authenticate a user.
 *
 * @param string $username Username.
 * @param string $password Password.
 * @return bool|WP_Error True on success, WP_Error on failure.
 */
function intimatetales_authenticate_user( $username, $password ) {
    $user = wp_authenticate( $username, $password );
    if ( is_wp_error( $user ) ) {
        return $user;
    }

    // Additional authentication logic or user meta updates can go here

    return true;
}

/**
 * Update user profile.
 *
 * @param int $user_id User ID.
 * @param array $user_data New user data.
 * @return bool|WP_Error True on success, WP_Error on failure.
 */
function intimatetales_update_user_profile( $user_id, $user_data ) {
    // Update user data logic goes here

    // Example: update user email
    if ( isset( $user_data['email'] ) && is_email( $user_data['email'] ) ) {
        wp_update_user( array( 'ID' => $user_id, 'user_email' => sanitize_email( $user_data['email'] ) ) );
    }

    // Additional user data updates can go here

    return true;
}

/**
 * Save user preferences.
 *
 * @param int $user_id User ID.
 * @param array $preferences User preferences.
 * @return bool True on success, false on failure.
 */
function intimatetales_save_user_preferences( $user_id, $preferences ) {
    // Save user preferences logic goes here
    foreach ( $preferences as $key => $value ) {
        update_user_meta( $user_id, $key, $value );
    }

    return true;
}

// Additional user management functions can be added here
