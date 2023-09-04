<?php

class InviteGenerator {

	private $databaseService;

	public 
    /**
     * __Construct
     * 
     * This method handles __construct functionality for InviteGenerator.
     */
function __Construct( DatabaseService $databaseService ) {
		$this->databaseService = $databaseService;
	}