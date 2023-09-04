<?php

class UserProfile {

	private User_Model $user;
	private array $profile_data;
	private Profile_Repository $profile_repository;

	public 
    /**
     * __Construct
     * 
     * This method handles __construct functionality for UserProfile.
     */
function __Construct( User_Model $user, Profile_Repository $profile_repository ) {
		$this->user               = $user;
		$this->profile_repository = $profile_repository;
		$this->hydrate();
	}