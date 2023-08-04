<?php

namespace IntimateTales\User\Actions;

use WP_Error;

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
}
