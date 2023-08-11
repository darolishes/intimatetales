<?php

namespace IntimateTales\Models\Invites;

use Exception;
use IntimateTales\Models\Invite;

class Sql_Invite_Repository implements Invite_Repository {

	private $invite;
	public $service;

	public function __construct( Invite $invite ) {
		$this->invite = $invite;
	}

	/**
	 * @return void
	 */
	public function createInvite( int $recipientId ) {
		try {
		} catch ( Exception $e ) {
			// Handle error
		}
	}

	public function getInviteUrl( int $recipientId, int $senderId ): string {
		$inviteToken = $this->service->getInviteToken( $recipientId, $senderId );

		$invite = new Invite( $inviteToken, $recipientId );

		return $invite->getUrl();
	}

	public function getInvites( int $limit, int $offset ): array {
		return $this->service->getInvites( $limit, $offset );
	}
}
