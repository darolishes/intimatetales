<?php

namespace IntimateTales\Models\User\Relationships;

use DateTime;

/**
 * Class Couple
 */
class Couple {
	private int $partner1Id;
	private int $partner2Id;
	private DateTime $joinedOn;

	public function __construct( int $partner1Id, int $partner2Id ) {
		$this->partner1Id = $partner1Id;
		$this->partner2Id = $partner2Id;
		$this->joinedOn   = new DateTime();
	}

	public function get_joined_on(): DateTime {
		return $this->joinedOn;
	}

	public function dissolve_relationship(): void {
		// Logic to dissolve the couple relationship
		// This could involve removing them from a couples' table or setting a status flag
	}

	// ... other methods as per your needs.
}
