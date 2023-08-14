<?php

namespace IntimateTales\Models\User;

defined( 'ABSPATH' ) || exit;

class User_Model {

	private int $id;
	private \WP_User $user;
	private User_Repository $user_repository;

	public function __construct( int $id, User_Repository $user_repository ) {
		$this->id              = $id;
		$this->user_repository = $user_repository;
		$this->load_data();
	}

	private function load_data(): void {
		$cached_user = wp_cache_get( "user_{$this->id}", 'users' );

		if ( $cached_user instanceof \WP_User ) {
			$this->user = $cached_user;
		} else {
			$this->user = $this->user_repository->get( $this->id );
			$this->cache_user();
		}
	}

	private function cache_user(): void {
		wp_cache_set( "user_{$this->id}", $this->user, 'users' );
	}

	public function get_username(): string {
		return $this->user->user_login;
	}

	// ... other methods can be added as per your needs.
}
