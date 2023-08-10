<?php

namespace IntimateTales\Invites;

/**
 * Interface for managing invites.
 */
interface InviteRepository
{

    /**
         * Create a new invite.
         *
         * @return void
         */
    public function createInvite( int $recipientId );

    /**
     * Get invite URL.
     *
     * @return string
     */
    public function getInviteUrl( int $recipientId, int $senderId );

    /**
     * Get invites.
     *
     * @return Invite[]
     */
    public function getInvites( int $limit, int $offset );
}
