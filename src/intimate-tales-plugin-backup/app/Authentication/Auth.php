<?php

namespace IntimateTales\Authentication;

use WP_Error;
use Exception;
use WP_User;
use IntimateTales\Routing\Redirector;
use IntimateTales\Authentication\UserManager;
use IntimateTales\Authentication\EmailManager;

class Auth
{
	private $userManager;
	private $emailManager;

	public function __construct()
	{
		$this->userManager = new UserManager();
		$this->emailManager = new EmailManager();
	}

	public function login(string $username, string $password)
	{
		$auth = $this->userManager->authenticate($username, $password);
		if ($auth instanceof WP_Error) {
			return ['error' => $auth->get_error_message()];
		}

		$this->redirect('dashboard');
	}

	public function logout()
	{
		$this->userManager->logout();
		$this->redirect('login');
	}

	public function register(string $username, string $password, string $email)
	{
		$this->userManager->register($username, $password, $email);
	}

	public function reset_password(string $email)
	{
		$this->userManager->reset_password($email);
	}

	public function change_password(int $user_id, string $new_password)
	{
		$this->userManager->change_password($user_id, $new_password);
	}

	public function update_user_email(int $user_id, string $new_email)
	{
		$this->userManager->update_user_email($user_id, $new_email);
	}

	public function forgot_password($email)
	{
		$this->userManager->forgot_password($email);
	}

	public function redirect($redirect)
	{
		$redirector = new Redirector();
		$redirector->to($redirect);
	}
}
```

```php
<?php

namespace IntimateTales\Authentication;

use WP_Error;
use Exception;
use WP_User;

class UserManager
{
	public function authenticate(string $username, string $password)
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

	public function logout()
	{
		wp_logout();
		exit;
	}

	public function register(string $username, string $password, string $email)
	{
		if ($this->check_user_exists($username) || $this->check_user_exists($email)) {
			view('auth.register', ['error' => __('Username or email already exists', 'intimate-tales')]);
			return;
		}

		$userdata = array(
			'user_login' => $username,
			'user_password' => $password,
			'user_email' => $email
		);

		$user_id = wp_create_user(
			$userdata['user_login'],
			$userdata['user_password'],
			$userdata['user_email']
		);

		if (is_wp_error($user_id)) {
			view('auth.register', ['error' => $user_id->get_error_message()]);
			return;
		}

		$this->send_verification_email($user_id);
		$this->redirect('login');
	}

	public function check_user_exists(string $email_or_username): bool
	{
		return email_exists($email_or_username) || username_exists($email_or_username);
	}

	public function reset_password(string $email)
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

		$this->send_password_reset_link($email, $key);
		view('auth.reset-password', ['message' => __('Password reset link has been sent to your email', 'intimate-tales')]);
	}

	public function change_password(int $user_id, string $new_password)
	{
		$userdata = array(
			'ID' => $user_id,
			'user_pass' => $new_password
		);

		$user_id = wp_update_user($userdata);

		if (is_wp_error($user_id)) {
			view('auth.change-password', ['error' => $user_id->get_error_message()]);
			return;
		}

		view('auth.change-password', ['message' => __('Password changed successfully', 'intimate-tales')]);
	}

	public function update_user_email(int $user_id, string $new_email)
	{
		if (!is_email($new_email)) {
			view('auth.update-email', ['error' => __('The provided email address is invalid', 'intimate-tales')]);
			return;
		}

		if (email_exists($new_email)) {
			view('auth.update-email', ['error' => __('The provided email address is already in use', 'intimate-tales')]);
			return;
		}

		$userdata = array(
			'ID' => $user_id,
			'user_email' => $new_email
		);

		$user_id = wp_update_user($userdata);

		if (is_wp_error($user_id)) {
			view('auth.update-email', ['error' => $user_id->get_error_message()]);
			return;
		}

		view('auth.update-email', ['message' => __('Email updated successfully', 'intimate-tales')]);
	}

	public function is_email_verified(int $user_id): bool
	{
		return (bool) get_user_meta($user_id, 'email_verified', true);
	}

	public function forgot_password($email)
	{
		$user = get_user_by('email', $email);

		if (!$user) {
			view('auth.forgot-password', [
				'error' => __('No user found for this email', 'intimate-tales')
			]);
			return;
		}

		$token = wp_generate_password(20, false);
		update_user_meta($user->ID, 'reset_password_token', $token);

		$this->send_password_reset_link($email, $token);

		view('auth.forgot-password', [
			'message' => __('The password reset link was sent to your email', 'intimate-tales')
		]);
	}
}
```

```php
<?php

namespace IntimateTales\Authentication;

use WP_Error;
use Exception;
use WP_User;

class EmailManager
{
	public function send_verification_email(int $user_id): bool
	{
		$user = get_userdata($user_id);
		$verification_link = home_url() . "/verify?user_id={$user_id}&token=" . wp_generate_password(20, false);

		$subject = __('Verify your email address', 'intimate-tales');
		$message = view('emails.verify-email', ['verification_link' => $verification_link]);

		return wp_mail($user->user_email, $subject, $message);
	}

	public function send_password_reminder_email(string $email): bool
	{
		$user = get_user_by('email', $email);

		if (!$user) {
			view('auth.forgot-password', ['error' => __('No user found for the given email address', 'intimate-tales')]);
			return false;
		}

		$subject = __('Password Reminder', 'intimate-tales');
		$message = view('emails.password-reminder', ['username' => $user->user_login]);

		return wp_mail($user->user_email, $subject, $message);
	}

	public function send_password_reset_link($email, $token)
	{
		$reset_link = get_site_url() . "/password-reset?token=" . $token;

		$subject = __('Password Reset Request', 'intimate-tales');
		$message = view('emails.password-reset', [
			'reset_link' => $reset_link,
			'email' => $email
		]);
		$headers = array('Content-Type: text/html; charset=UTF-8');

		wp_mail($email, $subject, $message, $headers);
	}
}