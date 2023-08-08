<?php

namespace IntimateTales\User\Actions;

use InvalidArgumentException;
use WP_Error;

/**
 * Handles user authentication actions such as login, registration, and password reset.
 */
class UserAuthentication
{
    /**
     * Authenticates a user with the given username and password.
     *
     * @param string $username
     * @param string $password
     * @return WP_Error|bool Returns true if authentication is successful, WP_Error otherwise.
     */
    private function authenticate(string $username, string $password)
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
            return new WP_Error('authentication_error', $user->get_error_message());
        }

        return true;
    }

    public function login(string $username, string $password)
    {
        return $this->authenticate($username, $password);
    }

    public function verifyIdentity(string $username, string $password): bool
    {
        return $this->authenticate($username, $password) === true;
    }

    /**
     * Registers a new user.
     *
     * @param string $username
     * @param string $password
     * @param string $email
     * @return WP_Error|int Returns user ID if registration is successful, WP_Error otherwise.
     */
    public function register(string $username, string $password, string $email)
    {
        $userdata = array(
            'user_login' => $username,
            'user_password' => $password,
            'user_email' => $email
        );

        $user_id = wp_insert_user($userdata);

        if (is_wp_error($user_id)) {
            return new WP_Error('registration_error', $user_id->get_error_message());
        }

        return $user_id;
    }

    /**
     * Resets the password of a user.
     *
     * @param string $email The email address of the user.
     * @return WP_Error|bool Returns true if password reset is successful, WP_Error otherwise.
     */
    public function resetPassword(string $email)
    {
        $user = get_user_by('email', $email);

        if (!$user) {
            return new WP_Error('reset_password_error', 'No user found for the given email address.');
        }

        $key = get_password_reset_key($user);

        if (is_wp_error($key)) {
            return new WP_Error('reset_password_key_error', $key->get_error_message());
        }

        // TODO: Send the reset key to the user's email address.
        // wp_mail($email, 'Password Reset', 'Your reset key is: ' . $key);

        return true;
    }

    /**
     * Logs out a user.
     */
    public function logout()
    {
        wp_logout();
    }

    /**
     * Checks if a user with the given email or username already exists.
     *
     * @param string $emailOrUsername
     * @return bool True if the user exists, false otherwise.
     */
    public function checkUserExists(string $emailOrUsername): bool
    {
        if (email_exists($emailOrUsername) || username_exists($emailOrUsername)) {
            return true;
        }

        return false;
    }

    /**
     * Changes the password of a user.
     *
     * @param int $user_id The ID of the user.
     * @param string $new_password The new password.
     * @return WP_Error|bool Returns true if password change is successful, WP_Error otherwise.
     */
    public function changePassword(int $user_id, string $new_password)
    {
        $userdata = array(
            'ID' => $user_id,
            'user_pass' => $new_password
        );

        $user_id = wp_update_user($userdata);

        if (is_wp_error($user_id)) {
            return new WP_Error('password_change_error', $user_id->get_error_message());
        }

        return true;
    }

    /**
     * Gets the current logged-in user's information.
     *
     * @return WP_User|false Returns WP_User object if user is logged in, false otherwise.
     */
    public function getCurrentUser()
    {
        return wp_get_current_user();
    }

    /**
     * Checks if a user is currently logged in.
     *
     * @return bool True if user is logged in, false otherwise.
     */
    public function isUserLoggedIn(): bool
    {
        return is_user_logged_in();
    }    /**
    * Updates the email of a user.
    *
    * @param int $user_id The ID of the user.
    * @param string $new_email The new email address.
    * @return WP_Error|bool Returns true if email update is successful, WP_Error otherwise.
    */
   public function updateUserEmail(int $user_id, string $new_email)
   {
       if (!is_email($new_email)) {
           return new WP_Error('email_invalid', 'The provided email address is invalid.');
       }

       if (email_exists($new_email)) {
           return new WP_Error('email_exists', 'The provided email address is already in use.');
       }

       $userdata = array(
           'ID' => $user_id,
           'user_email' => $new_email
       );

       $user_id = wp_update_user($userdata);

       if (is_wp_error($user_id)) {
           return new WP_Error('email_update_error', $user_id->get_error_message());
       }

       return true;
   }

   /**
    * Checks if a user's email address is verified.
    * Assumes a meta field 'email_verified' that stores a boolean value.
    *
    * @param int $user_id The ID of the user.
    * @return bool True if email is verified, false otherwise.
    */
   public function isEmailVerified(int $user_id): bool
   {
       return (bool) get_user_meta($user_id, 'email_verified', true);
   }

   /**
    * Sends a verification email to the user.
    * This is a basic implementation and assumes you have a way to handle verification links.
    *
    * @param int $user_id The ID of the user.
    * @return bool True if email was sent successfully, false otherwise.
    */
   public function sendVerificationEmail(int $user_id): bool
   {
       $user = get_userdata($user_id);
       $verification_link = home_url() . "/verify?user_id={$user_id}&token=" . wp_generate_password(20, false);

       $subject = 'Verify your email address';
       $message = "Click the link below to verify your email address:\n\n{$verification_link}";

       return wp_mail($user->user_email, $subject, $message);
   }

   /**
     * Sends a password reminder email to the user.
     *
     * @param string $email The email address of the user.
     * @return WP_Error|bool Returns true if email was sent successfully, WP_Error otherwise.
     */
    public function sendPasswordReminderEmail(string $email): bool
    {
        $user = get_user_by('email', $email);

        if (!$user) {
            return new WP_Error('user_not_found', 'No user found for the given email address.');
        }

        $subject = 'Password Reminder';
        $message = "Your username is: {$user->user_login}";

        return wp_mail($user->user_email, $subject, $message);
    }

    /**
     * Locks a user's account after a certain number of failed login attempts.
     * Assumes a meta field 'failed_login_attempts' that stores the number of failed attempts.
     *
     * @param int $user_id The ID of the user.
     * @return bool True if account is locked, false otherwise.
     */
    public function lockAccount(int $user_id): bool
    {
        $max_attempts = 5;
        $attempts = (int) get_user_meta($user_id, 'failed_login_attempts', true);

        if ($attempts >= $max_attempts) {
            update_user_meta($user_id, 'account_locked', true);
            return true;
        }

        return false;
    }

    /**
     * Unlocks a previously locked user's account.
     *
     * @param int $user_id The ID of the user.
     */
    public function unlockAccount(int $user_id)
    {
        delete_user_meta($user_id, 'account_locked');
        delete_user_meta($user_id, 'failed_login_attempts');
    }

   // ... [further additional methods if needed]
}