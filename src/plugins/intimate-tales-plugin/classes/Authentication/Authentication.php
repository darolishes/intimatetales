<?php

namespace IntimateTales\Authentication;

use WP_Error;
use Exception;
use WP_User;
use IntimateTales\Routing\Redirector;
use IntimateTales\Authentication\UserManager;

class Auth
{
    protected $user_manager;

    public function __construct()
    {
        $this->user_manager = new UserManager();
    }

    public function login(array $credentials)
    {
        return $this->user_manager->authenticate($credentials['username'], $credentials['password']);
    }

    public function logout()
    {
        $this->user_manager->logout();
    }

    public function register(array $data)
    {
        return $this->user_manager->register($data['username'], $data['password'], $data['email']);
    }
}