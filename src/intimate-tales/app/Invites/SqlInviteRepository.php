<?php

namespace IntimateTales\Invites;

use Exception;

class SqlInviteRepository implements InviteRepository
{

    private $invite;
    public $service;

    public function __construct( Invite $invite )
    {
        $this->invite = $invite;
    }

    /**
     * @return void
     */
    public function createInvite( int $recipientId )
    {
        try {
        } catch ( Exception $e ) {
            // Handle error
        }
    }

    public function getInviteUrl( int $recipientId, int $senderId ): string
    {
        $inviteToken = $this->service->getInviteToken( $recipientId, $senderId );

        $invite = new Invite( $inviteToken, $recipientId );

        return $invite->getUrl();
    }

    public function getInvites( int $limit, int $offset ): array
    {
        return $this->service->getInvites( $limit, $offset );
    }
}
