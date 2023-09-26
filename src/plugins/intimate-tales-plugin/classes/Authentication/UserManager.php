<?php
namespace IntimateTales\Authentication;

use WP_Error;
use Exception;
use WP_User;
use IntimateTales\Authentication\EmailManager;

class UserManager
{
    protected $email_manager;

    public function __construct(EmailManager $email_manager)
    {
        $this->email_manager = $email_manager;
    }

    /**
     * Authenticate a user.
     *
     * @param string $username
     * @param string $password
     * @return bool
     * @throws Exception
     */
	public function authenticate(string $username, string $password): bool
	{
		if (empty($username) || empty($password)) {
			throw new Exception(__('Username or password cannot be empty', 'intimate-tales'));
		}

		$creds = array(
			'user_login'    => $username,
			'user_password' => $password,
			'remember'      => true
		);

		$user = wp_signon($creds, false);

		if ($user instanceof WP_Error) {
			throw new Exception($user->get_error_message());
		}

		return true;
	}

    /**
     * Logout the current user.
     */
	public function logout(): void
	{
		wp_logout();
		exit;
	}

    /**
     * Register a new user.
     *
     * @param string $username
     * @param string $password
     * @param string $email
     * @throws Exception
     */
	public function register(string $username, string $password, string $email): void
    {
        if ($this->check_user_exists($username) || $this->check_user_exists($email)) {
            throw new Exception(__('Username or email already exists', 'intimate-tales'));
        }

        $userdata = array(
            'user_login' => $username,
            'user_pass' => $password,
            'user_email' => $email
        );

        $user_id = wp_insert_user($userdata);

        if (is_wp_error($user_id)) {
            throw new Exception($user_id->get_error_message());
        }

        $this->email_manager->send_verification_email($user_id);
        $this->redirect('login');
    }

    /**
     * Check if a user exists by email or username.
     *
     * @param string $email_or_username
     * @return bool
     */
	public function check_user_exists(string $email_or_username): bool
	{
		return email_exists($email_or_username) || username_exists($email_or_username);
	}

    /**
     * Reset a user's password by email.
     *
     * @param string $email
     */
	public function reset_password(string $email): void
	{
		$user = get_user_by('email', $email);

		if (!$user) {
			view('auth.reset-password', ['error' => __('No user found for the given email address', 'intimate-tales')]);
			return;
		}

		$key = get_password_reset_key($user);

		if (is_wp_error($key)) {
			view('auth.reset-password', ['error' => $key->get_error_message()]);
			return;
		}

		$this->email_manager->send_password_reset_link($email, $key);
		view('auth.reset-password', ['message' => __('Password reset link has been sent to your email', 'intimate-tales')]);
	}

    /**
     * Change a user's password.
     *
     * @param int $user_id
     * @param string $new_password
     * @return bool
     * @throws Exception
     */
	public function change_password(int $user_id, string $new_password)
	{
		$userdata = array(
			'ID' => $user_id,
			'user_pass' => $new_password
		);

		$user_id = wp_update_user($userdata);

		if (is_wp_error($user_id)) {
			throw new Exception($user_id->get_error_message());
		}

		return true;
	}

    /**
     * Update a user's email.
     *
     * @param int $user_id
     * @param string $new_email
     * @return bool
     * @throws Exception
     */
	public function update_user_email(int $user_id, string $new_email)
	{
		$userdata = array(
			'ID' => $user_id,
			'user_email' => $new_email
		);

		$user_id = wp_update_user($userdata);

		if (is_wp_error($user_id)) {
			throw new Exception($user_id->get_error_message());
		}

		return true;
	}
}