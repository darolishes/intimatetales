<?php

namespace IntimateTales\User\Profile;

use WP_User;

class UserPreferences
{
    private $wp_user;

    public function __construct(WP_User $user) 
    {
        $this->wp_user = $user; 
    }

    public function set(string $key, $value): void 
    {
        $this->validateKey($key);
        update_user_meta($this->wp_user->ID, $key, $value); 
    }

    public function get(string $key): mixed 
    {
        $this->validateKey($key);
        return get_user_meta($this->wp_user->ID, $key, true);
    }

    public function getAll(): array 
    {
        return get_user_meta($this->wp_user->ID);
    }

    public function add(array $preferences): void 
    {
        foreach ($preferences as $key => $value) {
            $this->validatePreference($key, $value);
            add_user_meta($this->wp_user->ID, $key, $value);
        }  
    }
    
    public function update(array $preferences): void
    {
        foreach ($preferences as $key => $value) {
            $this->validatePreference($key, $value);
            update_user_meta($this->wp_user->ID, $key, $value);
        }
    }
    
    public function delete(string $key): void
    {
        $this->validateKey($key); 
        delete_user_meta($this->wp_user->ID, $key);
    }
}