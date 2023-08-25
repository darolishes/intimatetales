<?php

class RelationshipManager extends BaseAction {
	private Participant $participant;

	public 
    /**
     * __Construct
     * 
     * This method handles __construct functionality for RelationshipManager.
     */
function __Construct( Participant $participant ) {
		$this->participant = $participant;
	}