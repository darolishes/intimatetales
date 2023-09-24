<?php
namespace IntimateTales\Authentication;

use WP_Error;
use Exception;
use WP_User;
use IntimateTales\Components\Component;
use IntimateTales\Routing\Redirector;
use IntimateTales\Authentication\UserManager;
use IntimateTales\Authentication\EmailManager;

/**
 * Class Authentication
 * 
 * @package IntimateTales
 * @subpackage Authentication
 * @since 1.0.0
 */
class Authentication extends Component
{
	private $user_manager;
	private $email_manager;

	public function on_create()
	{
		$this->user_manager = new UserManager();
		$this->email_manager = new EmailManager();
	}


	public function login(string $username, string $password)
	{
		$auth = $this->user_manager->authenticate($username, $password);
		if ($auth instanceof WP_Error) {
			return ['error' => $auth->get_error_message()];
		}

		$this->redirect('dashboard');
	}

	public function logout()
	{
		$this->user_manager->logout();
		$this->redirect('login');
	}

	public function register(string $username, string $password, string $email)
	{
		$this->user_manager->register($username, $password, $email);
	}

	public function reset_password(string $email)
	{
		$this->user_manager->reset_password($email);
	}

	public function change_password(int $user_id, string $new_password)
	{
		$this->user_manager->change_password($user_id, $new_password);
	}

	public function update_user_email(int $user_id, string $new_email)
	{
		$this->user_manager->update_user_email($user_id, $new_email);
	}

	public function forgot_password($email)
	{
		$this->user_manager->forgot_password($email);
	}

	public function redirect($redirect)
	{
		$redirector = new Redirector();
		$redirector->to($redirect);
	}
}