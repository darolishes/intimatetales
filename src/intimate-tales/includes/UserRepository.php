<?php
/**
 * class To handle data access for the user.
 */
class UserRepository {

	/**
	 * Get a user by ID.
	 *
	 * @param int $id
	 * @return \WP_User|bool
	 */
	public 
    /**
     * Get
     * 
     * This method handles get functionality for To.
     */
function Get( int $id ) {
		$user = wp_cache_get( "user_{$id}