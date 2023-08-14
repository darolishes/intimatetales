<?php

namespace IntimateTales\Models\User;

defined( 'ABSPATH' ) || exit;

/**
 * User_Repository class to handle data access for the user.
 */
class User_Repository {

	/**
	 * Get a user by ID.
	 *
	 * @param int $id
	 * @return \WP_User|bool
	 */
	public function get( int $id ) {
		$user = wp_cache_get( "user_{$id}", 'users' );

		if ( ! $user ) {
			$user = get_user_by( 'id', $id );
			wp_cache_set( "user_{$id}", $user, 'users' );
		}

		return $user;
	}
}
