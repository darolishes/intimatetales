<?php

namespace IntimateTales;

use IntimateTales\User;
use WP_User;

defined('ABSPATH') || exit;

class UserFactory
{
    public static function createFromWpUser(WP_User $wp_user): User
    {
        $user = new User($wp_user);
        $user->loadFromAcf();
        return $user;
    }

    public static function createFromUserId(int $user_id): ?User
    {
        $wp_user = get_user_by('ID', $user_id);
        return $wp_user ? self::createFromWpUser($wp_user) : null;
    }
}
