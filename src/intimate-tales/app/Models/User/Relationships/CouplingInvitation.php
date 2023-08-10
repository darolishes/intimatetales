<?php

namespace IntimateTales\Couple;

class Invitation
{

    public const INVITATION_KEY = 'couple_invitation';

    public function __construct(
        private int $inviterId,
        private int $inviteeId
    ) {
        $this->validate();
    }

    public function send(): void
    {
        add_user_meta(
            $this->inviteeId,
            self::INVITATION_KEY,
            $this->inviterId
        );
    }

    public function accept(): Couple
    {
        $this->remove();

        return new Couple(
            $this->inviterId,
            $this->inviteeId
        );
    }

    private function validate()
    {
        if ( $this->inviterId === $this->inviteeId ) {
            throw new Exception( 'Cannot invite yourself.' );
        }
    }

    private function remove()
    {
        delete_user_meta(
            $this->inviteeId,
            self::INVITATION_KEY,
            $this->inviterId
        );
    }
}
