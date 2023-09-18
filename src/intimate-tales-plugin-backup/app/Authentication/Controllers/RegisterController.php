<?php

namespace IntimateTales\Authentication\Controllers;

use IntimateTales\Authentication\Auth;

class RegisterController
{
    public function show_register_form()
    {
        view('auth.register');
    }

    public function register(array $data)
    {
        $auth = new Auth();
        $auth->register($data);
    }
}
