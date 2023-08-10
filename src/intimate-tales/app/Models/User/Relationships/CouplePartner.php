<?php

namespace IT\Models\User;

class CouplePartner
{

    private $userId;

    public function __construct( int $userId )
    {
        $this->userId = $userId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function isPartner( int $userId ): bool
    {
        return $this->userId === $userId;
    }
}
