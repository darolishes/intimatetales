<?php

namespace IntimateTales\User\Actions;

use InvalidArgumentException;

class UserAuthentication
{
    /**
     * Logs in a user with the given username and password.
     *
     * @param string $username
     * @param string $password
     * @return WP_Error|bool Returns true if the login is successful, WP_Error otherwise.
     */
    public function login(string $username, string $password)
    {
        if (empty($username) || empty($password)) {
            throw new InvalidArgumentException('Username and password cannot be empty');
        }

        $creds = array(
            'user_login'    => $username,
            'user_password' => $password,
            'remember'      => true
        );

        $user = wp_signon($creds, false);

        if (is_wp_error($user)) {
            // Return the error
            return new \WP_Error('login_error', $user->get_error_message());
        }

        // The login is successful
        return true;
    }

    /**
     * Register a new user with the given username, email, and password.
     *
     * @param string $username
     * @param string $email
     * @param string $password
     * @return bool Returns true if the user is successfully registered, false otherwise.
     */
    public function register(string $username, string $email, string $password)
    {
        if (empty($username) || empty($email) || empty($password)) {
            throw new InvalidArgumentException('Username, email, and password cannot be empty');
        }

        $user_id = wp_create_user($username, $password, $email);

        if (is_wp_error($user_id)) {
            return new \WP_Error('registration_error', $user_id->get_error_message());
        }

        return true;
    }

    /**
     * Logs out the current user, redirects to the home URL, and exits the script.
     *
     * @return void
     */
    public function logout(): void
    {
        wp_logout();
        wp_redirect(home_url());
        exit;
    }

    /**
     * Sends a password reset link to the user's email address.
     *
     * @param string $user_login The user's login name (username or email).
     * @return WP_Error|bool Returns true if the email was sent successfully, WP_Error otherwise.
     */
    public function forgotPassword(string $user_login)
    {
        if (empty($user_login)) {
            throw new InvalidArgumentException('User login cannot be empty');
        }

        $result = retrieve_password($user_login);

        if (is_wp_error($result)) {
            // Return the error
            return new \WP_Error('password_reset_error', $result->get_error_message());
        }

        // The email was sent successfully
        return true;
    }

    public function verifyIdentity(string $username, string $password): bool
    {
        if (empty($username) || empty($password)) {
            throw new InvalidArgumentException('Username and password cannot be empty');
        }

        $creds = array(
            'user_login'    => $username,
            'user_password' => $password,
            'remember'      => true
        );

        $user = wp_signon($creds, false);

        if (is_wp_error($user)) {
            // Return the error
            return false;
        }

        // The login is successful
        return true;
    }
}
// Compare this snippet from www/wp-content/plugins/intimate-tales/classes/User/Profile/UserProfile.php: