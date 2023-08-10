<?php

namespace IntimateTales\Invites;

use \InvalidArgumentException;

class InviteGenerator
{

    public function generate(int $recipientId): Invite
    {
        if ($recipientId < 1) {
            throw new InvalidArgumentException('Invalid recipient ID');
        }

        $token = self::generateToken();

        return new Invite($token, $recipientId);
    }

    private function generateToken()
    {
        // Generate a unique token   
        return substr(md5(rand()), 0, 8);
    }
}
