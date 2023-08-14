<?php

namespace IntimateTales\Models\User\Relationships;

class Relationship_Manager {
	private Participant $participant;

	public function __construct( Participant $participant ) {
		$this->participant = $participant;
	}

	public function add_relationship( Participant $other_participant ): void {
		// Logic to add a relationship in WordPress database
	}

	public function remove_relationship( Participant $other_participant ): void {
		// Logic to remove a relationship from WordPress database
	}

	public function check_relationship_with( Participant $other_participant ): string {
		// Logic to check relationship status with another participant
		// Could return values like "friends", "couple", "none", etc.
	}
}
