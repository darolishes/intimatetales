<?php

namespace IntimateTales\Models\User;

use IntimateTales\Models\User\Relationships\Couple_Invitation;

class User_Action {
	private Participant $participant;

	public function __construct( Participant $participant ) {
		$this->participant = $participant;
	}

	// Send an invitation to another participant
	public function send_invitation( Participant $recipient ): void {
		$invitation = new Couple_Invitation( $this->participant, $recipient );
		$invitation->send();
	}

	// Accept an invitation from another participant
	public function accept_invitation( Participant $sender ): void {
		$invitation = new Couple_Invitation( $sender, $this->participant );
		$invitation->accept();
	}

	// Decline an invitation from another participant
	public function decline_invitation( Participant $sender ): void {
		$invitation = new Couple_Invitation( $sender, $this->participant );
		$invitation->remove();
	}

	// Get the participant's user profile
	public function get_profile(): User_Profile {
		$user_model         = new User_Model( $this->participant->get_id() );
		$profile_repository = new Profile_Repository();
		return new User_Profile( $user_model, $profile_repository );
	}
}
