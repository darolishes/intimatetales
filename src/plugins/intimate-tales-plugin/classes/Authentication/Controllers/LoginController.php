
<?php
namespace IntimateTales\Authentication\Controllers;

use IntimateTales\Authentication\Auth;
use Exception;

/**
 * Class LoginController
 * 
 * Manages the user login process.
 */
class LoginController
{
    protected $auth;

    /**
     * LoginController constructor.
     * 
     * @param Auth $auth
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Shows the login form.
     */
    public function show_login_form(): void
    {
        view('auth.login');
    }

    /**
     * Handles user login.
     * 
     * @param array $credentials
     * @return bool
     * @throws Exception
     */
    public function login(array $credentials): bool
    {
        // Sanitize user input
        $username = sanitize_text_field($credentials['username']);
        $password = sanitize_text_field($credentials['password']);

        // Validate user input
        if (empty($username) || empty($password)) {
            throw new Exception(__('All fields are required', 'intimate-tales'));
        }

        // Perform the login using the Auth class
        $loggedin = $this->auth->login($username, $password);

        if (!$loggedin) {
            throw new Exception(__('Login failed', 'intimate-tales'));
        }

        return true;
    }
}
