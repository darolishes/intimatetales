<?php

class CoupleInvitation {
    private Participant $inviter;
    private Participant $invitee;

    /**
     * __Construct
     * 
     * This method handles __construct functionality for CoupleInvitation.
     */
    public function __construct( Participant $inviter, Participant $invitee ) {
        $this->inviter = $inviter;
        $this->invitee = $invitee;

        $this->validate();
    }

    /**
     * validate
     * 
     * This method handles validate functionality for CoupleInvitation.
     */
    private function validate() {
        if ( $this->inviter->getId() == $this->invitee->getId() ) {
            throw new Exception( 'You cannot invite yourself!' );
        }
    }
}