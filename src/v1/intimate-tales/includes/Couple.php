<?php

class Couple {
	private int $partner1Id;
	private int $partner2Id;
	private DateTime $joinedOn;

    /**
     * __construct
     * 
     * This method handles __construct functionality for Couple.
     */

	public function __construct( int $partner1Id, int $partner2Id ) {
		$this->partner1Id = $partner1Id;
		$this->partner2Id = $partner2Id;
		$this->joinedOn   = new DateTime();
	}
}