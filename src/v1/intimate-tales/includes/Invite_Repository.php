<?php

namespace IntimateTales\Models\Invites;

/**
 * Interface for managing invites.
 */
interface Invite_Repository {


	/**
	 * Create a new invite.
	 *
	 * @return void
	 */
	public function Createinvite( int $recipientId);

	/**
	 * Get invite URL.
	 *
	 * @return string
	 */
	public function Getinviteurl( int $recipientId, int $senderId);

	/**
	 * Get invites.
	 *
	 * @return Invite[]
	 */
	public function Getinvites( int $limit, int $offset);
}
