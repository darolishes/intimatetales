<?php
namespace IntimateTales\Authentication\EmailManager;

/**
 * Class EmailManager
 * 
 * @package IntimateTales
 * @subpackage Authentication
 * @since 1.0.0
 */
class EmailManager
{
    /**
     * Sends a verification email to the user
     * 
     * @param int $user_id
     * @return bool
     */
	public function send_verification_email(int $user_id): bool
	{
		$user = get_userdata($user_id);
		$verification_link = home_url() . "/verify?user_id={$user_id}&token=" . wp_generate_password(20, false);

		$subject = __('Verify your email address', 'intimate-tales');
		$message = view('emails.verify-email', ['verification_link' => $verification_link]);

		return wp_mail($user->user_email, $subject, $message);
	}

    /**
     * Sends a password reminder email to the user
     * 
     * @param string $email
     */
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

    /**
     * Sends a password reset link to the user
     * 
     * @param string $email
     * @param string $token
     * @return void
     */
	public function send_password_reset_link($email, $token): void
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

    /**
     * Sends a password reset confirmation email to the user
     * 
     * @param string $email
     * @return void
     */
    public function send_password_reset_confirmation_email($email): void
    {
        $subject = __('Password Reset Confirmation', 'intimate-tales');
        $message = view('emails.password-reset-confirmation', ['email' => $email]);
        $headers = array('Content-Type: text/html; charset=UTF-8');

        wp_mail($email, $subject, $message, $headers);
    }
}