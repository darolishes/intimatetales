<?php

namespace IntimateTales\User\CouplingInvitation;

class CouplingInvitation
{
    private $sender;
    private $recipient;
    private $message;

    public function __construct($sender, $recipient, $message)
    {
        $this->sender = $sender;
        $this->recipient = $recipient;
        $this->message = $message;
    }

    public function getSender()
    {
        return $this->sender;
    }

    public function getRecipient()
    {
        return $this->recipient;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function createInvitation($sender, $recipient, $message)
    {
        $invitation = new CouplingInvitation($sender, $recipient, $message);
        return $invitation;
    }
}
