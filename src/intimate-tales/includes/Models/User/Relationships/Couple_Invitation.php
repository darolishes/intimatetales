<?php

namespace IntimateTales\Models\User\Relationships;

use Exception;

class Couple_Invitation {
private Participant $inviter;
private Participant $invitee;

public function __construct( Participant $inviter, Participant $invitee ) {
	$this->inviter = $inviter;
	$this->invitee = $invitee;

	$this->validate();
}

public function send(): void {
	add_user_meta(
		$this->invitee->get_id(),
		self::INVITATION_KEY,
		$this->inviter->get_id()
	);
}

public function accept(): void {
	// Logic to accept the invitation and form a relationship
}

private function validate() {
	if ( $this->inviter->get_id() === $this->invitee->get_id() ) {
		throw new Exception( 'Cannot invite yourself.' );
	}
}

private function remove() {
	delete_user_meta(
		$this->invitee->get_id(),
		self::INVITATION_KEY,
		$this->inviter->get_id()
	);
}
