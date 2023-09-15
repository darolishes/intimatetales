<?php
/**
 * IntimateTales Authentication Class
 */

if (!defined('ABSPATH')) {
    exit;
}

class IntimateTales_Authentication {

    /**
     * Constructor.
     */
    public function __construct() {
        // Add hooks related to authentication.
        add_action('init', array($this, 'initialize_authentication'));
    }

    /**
     * Initialize the authentication processes.
     */
    public function initialize_authentication() {
        add_action('wp_login_failed', array($this, 'handle_failed_login'));
        add_action('wp_login', array($this, 'handle_successful_login'), 10, 2);
    }

    /**
     * Handle failed login attempts.
     */
    public function handle_failed_login() {
        $referrer = $_SERVER['HTTP_REFERER'];
        if (!empty($referrer) && !strstr($referrer, 'wp-login') && !strstr($referrer, 'wp-admin')) {
            wp_redirect($referrer . '?login=failed');
            exit;
        }
    }

    /**
     * Handle successful login attempts.
     *
     * @param string $user_login The user's login name.
     * @param object $user The WP_User object.
     */
    public function handle_successful_login($user_login, $user) {
        // Two-Factor Authentication check.
        if (!get_user_meta($user->ID, 'two_factor_auth_passed', true)) {
            // Logic to handle two-factor authentication.
            // Send a token to the user's email.
            $token = wp_generate_password(20, false);
            update_user_meta($user->ID, 'two_factor_auth_token', wp_hash_password($token));
            $email_content = sprintf(__('Your authentication code is: %s'), $token);
            wp_mail($user->user_email, __('Two-Factor Authentication Code'), $email_content);

            // Redirect to a page where they can input the token.
            wp_logout();
            wp_redirect(home_url() . '?authentication=two_factor_required');
            exit;
        }
    }

    /**
     * Handle the token validation for two-factor authentication.
     *
     * @param string $token The token input by the user.
     * @param object $user The WP_User object.
     * @return bool Whether the token is valid or not.
     */
    public function validate_two_factor_token($token, $user) {
        $saved_token = get_user_meta($user->ID, 'two_factor_auth_token', true);
        if (wp_check_password($token, $saved_token, $user->ID)) {
            // Mark two-factor as passed for this session.
            update_user_meta($user->ID, 'two_factor_auth_passed', true);
            return true;
        }
        return false;
    }

}

// Initialize the authentication class.
new IntimateTales_Authentication();