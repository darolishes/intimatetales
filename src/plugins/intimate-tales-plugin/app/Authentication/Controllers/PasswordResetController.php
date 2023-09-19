<?php

namespace IntimateTales\Authentication\Controllers;

class PasswordResetController
{
    public function showResetForm()
    {
        view('auth.password_reset');
    }

    public function resetPassword(array $data)
    {
    }
}
