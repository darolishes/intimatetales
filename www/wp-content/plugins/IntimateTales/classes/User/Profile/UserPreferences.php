<?php

namespace IntimateTales\User\Profile;

class UserPreferences
{
    public function setPreference(string $key, $value): void
    {
        update_user_meta($this->wp_user->ID, $key, $value);
    }

    public function getPreference(string $key)
    {
        return get_user_meta($this->wp_user->ID, $key, true);
    }

    public function getPreferences(int $userId): array
    {
        // Implement logic to get user preferences
        // Example implementation:
        // return array(
        //     'preference1' => 'value1',
        //     'preference2' => 'value2',
        //     'preference3' => 'value3',
        // );
    }

    public function setPreferences(int $userId, array $newPreferences): bool
    {
        // Implement logic to set user preferences
        // Example implementation:
        // return true; // if preferences are successfully set
        // return false; // if setting preferences fails
    }

    public function save()
    {
        // Implement the logic to save the current state of the object in the database.
        // Throw an exception if the save operation fails.
    }
}
// Compare this snippet from www/wp-content/plugins/intimate-tales/classes/User/Relationships/UserRelationships.php: