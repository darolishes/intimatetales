<?php

namespace IntimateTales\Authentication\Controllers;

use IntimateTales\Authentication\Auth;

class LoginController
{
    public function show_login_form()
    {
        view('auth.login');
    }

    public function login(array $credentials)
    {
        $auth = new Auth();
        $auth->login($credentials);
    }
}
