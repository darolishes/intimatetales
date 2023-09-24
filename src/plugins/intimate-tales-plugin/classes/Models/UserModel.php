<?php
namespace IntimateTales\Models;

use WP_User;
use Exception;

class UserModel extends Model
{
    protected WP_User $user;

    public function __construct(WP_User $user)
    {
        parent::__construct(['user' => $user]);
        $this->load_meta();
    }

    protected function load_meta(): void
    {
        $this->meta = get_user_meta($this->user->ID);
    }

    public static function find(int $id): static
    {
        $user = get_user_by('id', $id);
        if (!$user) {
            throw new Exception('User not found');
        }
        return new static($user);
    }

    public static function all(): array
    {
        $users = get_users(['number' => -1]);
        return array_map(fn($user) => new static($user), $users);
    }
}