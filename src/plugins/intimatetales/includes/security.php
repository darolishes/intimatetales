<?php
/**
 * Security functions for IntimateTales WordPress plugin.
 */

// Ensure WordPress environment
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Sanitize input data.
 *
 * @param mixed $data The input data to be sanitized.
 * @return mixed Sanitized data.
 */
function intimatetales_sanitize_input( $data ) {
    if ( is_array( $data ) ) {
        return array_map( 'intimatetales_sanitize_input', $data );
    }
    return sanitize_text_field( $data );
}

/**
 * Validate user authentication.
 *
 * @param string $username Username to validate.
 * @param string $password Password to validate.
 * @return bool True if valid, false otherwise.
 */
function intimatetales_validate_authentication( $username, $password ) {
    $user = get_user_by( 'login', $username );
    if ( $user && wp_check_password( $password, $user->data->user_pass, $user->ID ) ) {
        return true;
    }
    return false;
}

/**
 * Custom authentication process.
 *
 * @param string $username Username.
 * @param string $password Password.
 */
function intimatetales_custom_authentication( $username, $password ) {
    if ( ! intimatetales_validate_authentication( $username, $password ) ) {
        // Handle authentication failure
        wp_die( 'Authentication failed. Please check your credentials.' );
    } else {
        // Handle successful authentication
        wp_set_current_user( $user->ID );
        wp_set_auth_cookie( $user->ID );
        do_action( 'wp_login', $username );
    }
}

/**
 * Enforce strong passwords.
 *
 * @param bool $check Whether to enforce strong passwords.
 * @param string $password The password.
 * @param int $user_id User ID.
 * @return bool Whether the password is strong.
 */
function intimatetales_enforce_strong_passwords( $check, $password, $user_id ) {
    require_once ABSPATH . WPINC . '/class-phpass.php';
    $wp_hasher = new PasswordHash( 8, true );
    if ( $wp_hasher->CheckPassword( $password, $user->data->user_pass ) ) {
        return true;
    }
    return false;
}
add_filter( 'check_password_strength', 'intimatetales_enforce_strong_passwords', 10, 3 );

/**
 * Security headers.
 */
function intimatetales_security_headers() {
    header( 'X-Content-Type-Options: nosniff' );
    header( 'X-Frame-Options: SAMEORIGIN' );
    header( 'X-XSS-Protection: 1; mode=block' );
    header( 'Referrer-Policy: no-referrer-when-downgrade' );
}
add_action( 'send_headers', 'intimatetales_security_headers' );
