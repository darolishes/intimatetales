<?php
namespace IntimateTales\Models;

use WP_User;
use Exception;

abstract class UserModel extends Model
{
    protected WP_User $user;
    protected array $meta;

    public function __construct(WP_User $user)
    {
        parent::__construct(['user' => $user]);
        $this->loadMeta();
    }

    protected function loadMeta(): void
    {
        $this->meta = get_user_meta($this->user->ID);
    }

    public static function find(int $id): ?self
    {
        $user = get_user_by('id', $id);
        if (!$user) {
            return null;
        }
        return new self($user);
    }

    public function getId(): int
    {
        return $this->user->ID;
    }

    public function getEmail(): string
    {
        return $this->user->user_email;
    }

    public static function all(): array
    {
        $users = get_users(['number' => -1]);
        return array_map(fn($user) => new static($user), $users);
    }
}