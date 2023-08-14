<?php

namespace IntimateTales\Models\User\Relationships;

class Participant {
	private int $user_id;

	public function __construct( int $user_id ) {
		$this->user_id = $user_id;
	}

	public function get_id(): int {
		return $this->user_id;
	}

	public function get_profile_picture(): string {
		return get_avatar_url( $this->user_id );
	}

	public function get_description(): string {
		return get_user_meta( $this->user_id, 'description', true );
	}
}
