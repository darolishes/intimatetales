<?php

namespace IntimateTales\Models\User;

defined( 'ABSPATH' ) || exit;

class Profile_Repository {

	/**
	 * Get a user profile by user ID.
	 *
	 * @param int $id
	 * @return array|null
	 */
	public function get( int $id ) {
		$profile = wp_cache_get( "profile_{$id}", 'profiles' );

		if ( ! $profile ) {
			$user_meta  = get_user_meta( $id );
			$acf_fields = acf_get_fields( 'group_user_profile', $id );

			$profile = array(
				'user_meta'  => $user_meta,
				'acf_fields' => $acf_fields,
			);

			$this->set( $id, $profile );
		}

		return $profile;
	}

	/**
	 * Cache the user profile.
	 *
	 * @param int   $id
	 * @param array $profile
	 * @return bool
	 */
	public function set( int $id, array $profile ) {
		return wp_cache_set( "profile_{$id}", $profile, 'profiles', 3600 );
	}

	/**
	 * Invalidate the cached user profile.
	 *
	 * @param int $id
	 * @return bool
	 */
	public function invalidate( int $id ) {
		return wp_cache_delete( "profile_{$id}", 'profiles' );
	}
}
