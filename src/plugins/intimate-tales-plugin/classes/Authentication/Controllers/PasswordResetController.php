
<?php
namespace IntimateTales\Authentication\Controllers;

use IntimateTales\Authentication\UserManager;
use Exception;

/**
 * Class PasswordResetController
 * 
 * Manages the password reset process for users.
 */
class PasswordResetController
{
    protected $user_manager;

    /**
     * PasswordResetController constructor.
     * 
     * @param UserManager $user_manager
     */
    public function __construct(UserManager $user_manager)
    {
        $this->user_manager = $user_manager;
    }

    /**
     * Show the password reset form.
     */
    public function showResetForm(): void
    {
        view('auth.password_reset');
    }

    /**
     * Reset the user password.
     * 
     * @param array $data
     * @throws Exception
     */
    public function resetPassword(array $data): void
    {
        // Sanitize and validate email address
        $email = sanitize_email($data['email']);
        if (!is_email($email)) {
            throw new Exception(__('Invalid email address', 'intimate-tales'));
        }

        // Perform the password reset using the UserManager class
        $this->user_manager->reset_password($email);
    }
}
