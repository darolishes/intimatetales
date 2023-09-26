
<?php
namespace IntimateTales\Authentication\Controllers;

use IntimateTales\Authentication\Auth;
use Exception;

/**
 * Class RegisterController
 * 
 * Manages the user registration process.
 */
class RegisterController
{
    protected $auth;

    /**
     * RegisterController constructor.
     * 
     * @param Auth $auth
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Shows the registration form.
     */
    public function show_register_form(): void
    {
        view('auth.register');
    }

    /**
     * Handles user registration.
     * 
     * @param array $data
     * @return bool
     * @throws Exception
     */
    public function register(array $data): bool
    {
        // Sanitize user input
        $username = sanitize_text_field($data['username']);
        $password = sanitize_text_field($data['password']);
        $email = sanitize_email($data['email']);

        // Validate user input
        if (empty($username) || empty($password) || empty($email)) {
            throw new Exception(__('All fields are required', 'intimate-tales'));
        }

        // Perform the registration using the Auth class
        $registered = $this->auth->register($username, $password, $email);

        if (!$registered) {
            throw new Exception(__('Registration failed', 'intimate-tales'));
        }

        return true;
    }
}
