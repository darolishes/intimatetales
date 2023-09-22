<?php

class SqlInviteRepository implements Invite_Repository {

	private $invite;
	public $service;

	public 
    /**
     * __Construct
     * 
     * This method handles __construct functionality for SqlInviteRepository.
     */
function __Construct( Invite $invite ) {
		$this->invite = $invite;
	}