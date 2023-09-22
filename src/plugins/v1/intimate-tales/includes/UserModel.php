<?php

class UserModel {

	private int $id;
	private \WP_User $user;
	private User_Repository $user_repository;

	public 
    /**
     * __Construct
     * 
     * This method handles __construct functionality for UserModel.
     */
function __Construct( int $id, User_Repository $user_repository ) {
		$this->id              = $id;
		$this->user_repository = $user_repository;
		$this->load_data();
	}