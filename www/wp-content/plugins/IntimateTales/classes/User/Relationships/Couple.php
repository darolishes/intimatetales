<?php

namespace IntimateTales\User\Relationships;

use IntimateTales\User\CouplingInvitation;

use InvalidArgumentException;

class Couple
{
    const COUPLE_INVITATIONS = 'couple_invitations';
    const COUPLE_CREATION_DATE = 'couple_creation_date';
    public const COUPLE_ID = 'couple_id';

    private ?string $couple_id = null; // The ID of the couple.
    private int $user1_id = 0; // The ID of the first user in the couple.
    private int $user2_id = 0; // The ID of the second user in the couple.
    private ?string $creation_date = null; // The creation date of the couple.


    // Constructor
    public function __construct(?string $couple_id = null, int $user1_id = 0, int $user2_id = 0, ?string $creation_date = null)
    {
        if (!is_null($user1_id) && !is_numeric($user1_id)) {
            throw new \InvalidArgumentException("User1 ID must be a number.");
        }
        if (!is_null($user2_id) && !is_numeric($user2_id)) {
            throw new \InvalidArgumentException("User2 ID must be a number.");
        }
        $this->couple_id = $couple_id;
        $this->user1_id = $user1_id;
        $this->user2_id = $user2_id;
        $this->creation_date = $creation_date;
    }

    public function getCouple(int $userId): ?int
    {
        if ($userId <= 0) {
            throw new InvalidArgumentException('Invalid user ID');
        }

        $couple = null;
        $userMeta = get_user_meta($userId, self::COUPLE_INVITATIONS, true);
        if (!empty($userMeta)) {
            $couple = $userMeta[self::COUPLE_ID];
        }
        return $couple;
    }

    public function createCouple(int $user1Id, int $user2Id): bool
    {
        if ($user1Id <= 0 || $user2Id <= 0) {
            throw new InvalidArgumentException('Invalid user IDs');
        }

        $user1 = get_userdata($user1Id);
        $user2 = get_userdata($user2Id);
        if ($user1 === false || $user2 === false) {
            throw new InvalidArgumentException('Invalid user IDs');
        }
        $invitation = new CouplingInvitation();
        $invitation->createInvitation($user1Id, $user2Id);
        return true;
    }

    public function breakUp(int $user1Id, int $user2Id): bool
    {
        if ($user1Id <= 0 || $user2Id <= 0) {
            throw new InvalidArgumentException('Invalid user IDs');
        }
        // Rest of the code...
    }

    public function save()
    {
        // Implement the logic to save the current state of the object in the database.
        // Throw an exception if the save operation fails.
    }
}