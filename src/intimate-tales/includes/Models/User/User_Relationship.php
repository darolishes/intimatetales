<?php

namespace IntimateTales\Models\User;

use IntimateTales\Models\User\Relationships\Relationship_Manager;

class User_Relationship {
	private Participant $participant;

	public function __construct( Participant $participant ) {
		$this->participant = $participant;
	}

	// Add a relationship with another participant
	public function add_relationship( Participant $other_participant ): void {
		$relationship_manager = new Relationship_Manager( $this->participant );
		$relationship_manager->add_relationship( $other_participant );
	}

	// Remove a relationship with another participant
	public function remove_relationship( Participant $other_participant ): void {
		$relationship_manager = new Relationship_Manager( $this->participant );
		$relationship_manager->remove_relationship( $other_participant );
	}

	// Check relationship status with another participant
	public function check_relationship_with( Participant $other_participant ): string {
		$relationship_manager = new Relationship_Manager( $this->participant );
		return $relationship_manager->check_relationship_with( $other_participant );
	}
}
