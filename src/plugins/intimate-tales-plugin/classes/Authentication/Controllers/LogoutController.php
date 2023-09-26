
<?php
namespace IntimateTales\Authentication\Controllers;

use IntimateTales\Authentication\Auth;

/**
 * Class LogoutController
 * 
 * Manages the user logout process.
 */
class LogoutController
{
    protected $auth;

    /**
     * LogoutController constructor.
     * 
     * @param Auth $auth
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handles user logout.
     */
    public function logout(): void
    {
        $this->auth->logout();
    }
}
