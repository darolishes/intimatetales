<?php

namespace IntimateTales\User\Profile;

use WP_Error;
use InvalidArgumentException;

class UserProfile
{
    /**
     * Updates a user's profile with the given data.
     *
     * @param int $user_id
     * @param array $userdata
     * @return bool|WP_Error Returns true if the update is successful, WP_Error otherwise.
     */
    public function updateProfile(int $user_id, array $userdata)
    {
        if ($user_id <= 0 || empty($userdata)) {
            throw new InvalidArgumentException('Invalid user ID or user data');
        }
        $result = wp_update_user($userdata);

        if (is_wp_error($result)) {
            return new \WP_Error('registration_error', $result->get_error_message());
        }

        // The update is successful
        return true;
    }

    /**
     * Changes a user's password.
     *
     * @param int $user_id
     * @param string $old_password
     * @param string $new_password
     * @return bool|WP_Error Returns true if the password change is successful, WP_Error otherwise.
     */
    public function changePassword(int $user_id, string $old_password, string $new_password)
    {
        if ($user_id <= 0 || empty($old_password) || empty($new_password)) {
            throw new InvalidArgumentException('Invalid user ID or password');
        }

        $user = get_user_by('id', $user_id);

        if ($user && wp_check_password($old_password, $user->data->user_pass, $user_id)) {
            // Check for a strong password
            $strength = apply_filters('check_password_strength', null, $new_password, array());

            if ($strength < 3) {
                return new \WP_Error('weak_password', __('Password is too weak.', 'intimate-tales'));
            }

            // Update the user's password
            wp_set_password($new_password, $user_id);
            return true;
        } else {
            return new \WP_Error('incorrect_password', __('The old password is incorrect.', 'intimate-tales'));
        }
    }

    public function setPreference(int $userId, string $key, $value)
    {
        // Implement the logic to set the preference...
    }

    public function getPreference(int $userId, string $key)
    {
        // Implement the logic to get the preference...
    }

    public function save()
    {
        // Implement the logic to save the current state of the object in the database.
        // Throw an exception if the save operation fails.
    }
}
