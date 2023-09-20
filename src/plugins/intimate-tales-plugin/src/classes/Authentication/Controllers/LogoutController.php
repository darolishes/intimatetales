<?php

namespace IntimateTales\Authentication\Controllers;

use IntimateTales\Authentication\Auth;

class LogoutController
{
    public function logout()
    {
        $auth = new Auth();
        $auth->logout();
    }
}
