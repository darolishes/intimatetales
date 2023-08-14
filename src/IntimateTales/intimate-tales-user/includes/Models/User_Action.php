<?php

namespace IntimateTales\Models\User;

use IntimateTales\Models\User\Relationships\Couple_Invitation;

class User_Action {
	private Participant $participant;

	public function __construct(Participant $participant) {
		$this->participant = $participant;
	}

	// Send an invitation to another participant
	public function send_invitation(Participant $recipient): void {
		$invitation = new Couple_Invitation($this->participant, $recipient);
		$invitation->send();
	}

	// Accept an invitation from another participant
	public function accept_invitation(Participant $sender): void {
		$invitation = new Couple_Invitation($sender, $this->participant);
		$invitation->accept();
	}

	// Decline an invitation from another participant
	public function decline_invitation(Participant $sender): void {
		$invitation = new Couple_Invitation($sender, $this->participant);
		$invitation->remove();
	}

	// Get the participant's user profile
	public function get_profile(): User_Profile {
		$user_model         = new User_Model($this->participant->get_id());
		$profile_repository = new Profile_Repository();
		return new User_Profile($user_model, $profile_repository);
	}

	/**
	 * Logs a user in.
	 * 
	 * @param string $username
	 * @param string $password
	 * @param bool $remember
	 * 
	 * @return bool|WP_Error
	 */
	public function login($username, $password, $remember = false) {
		$creds = array(
			'user_login'    => $username,
			'user_password' => $password,
			'remember'      => $remember
		);

		$user = wp_signon($creds, false);

		if (is_wp_error($user)) {
			return $user;
		}

		return true;
	}

	/**
	 * Registers a new user.
	 * 
	 * @param string $username
	 * @param string $email
	 * 
	 * @return int|WP_Error
	 */
	public function register($username, $email) {
		$user_id = wp_create_user($username, wp_generate_password(), $email);

		if (is_wp_error($user_id)) {
			return $user_id;
		}

		return $user_id;
	}

	/**
	 * Sends password reset link.
	 * 
	 * @param string $user_login
	 * 
	 * @return bool|WP_Error
	 */
	public function forgot_password($user_login) {
		$user_data = get_user_by('login', $user_login);

		if (!$user_data) {
			$user_data = get_user_by('email', $user_login);
		}

		if (!$user_data) {
			return new WP_Error('invalid_user', __('Invalid username or email.'));
		}

		// Generate password reset key.
		$key = get_password_reset_key($user_data);

		if (is_wp_error($key)) {
			return $key;
		}

		// TODO: Send email to user with password reset link.

		return true;
	}
}
