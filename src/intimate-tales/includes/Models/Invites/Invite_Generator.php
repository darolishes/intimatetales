<?php

namespace IntimateTales\Models\Invites;

use IntimateTales\Models\Invites\Invite;
use IntimateTales\Services\DatabaseService;
use InvalidArgumentException;

class Invite_Generator {

	private $databaseService;

	public function __construct( DatabaseService $databaseService ) {
		$this->databaseService = $databaseService;
	}

	public function generate( int $recipientId ): Invite {
		$this->validateRecipientId( $recipientId );

		$token = $this->generateToken();

		return new Invite( $token, $recipientId, $this->databaseService );
	}

	public function createAndSaveInvite( int $recipientId ): Invite {
		$invite = $this->generate( $recipientId );

		// Save the invite to the database
		$invite->insertInvite();

		return $invite;
	}

	private function validateRecipientId( int $recipientId ) {
		if ( $recipientId < 1 ) {
			throw new InvalidArgumentException( 'Invalid recipient ID' );
		}
	}

	public function generateToken() {
		// Generate a unique token
		return substr( md5( rand() ), 0, 8 );
	}
}
