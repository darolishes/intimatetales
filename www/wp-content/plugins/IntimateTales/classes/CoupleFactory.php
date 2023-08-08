<?php

namespace IntimateTales;

defined('ABSPATH') || exit;

use IntimateTales\Couple;

class CoupleFactory
{
    public function createCouple(int $user1_id, int $user2_id): Couple
    {
        Couple::validateUserId($user1_id);
        Couple::validateUserId($user2_id);

        if (User::getUserById($user1_id)->isPartOfCouple() || User::getUserById($user2_id)->isPartOfCouple()) {
            throw new UserAlreadyInCoupleException("One or both users are already part of a couple.");
        }

        $couple_id = wp_generate_uuid4();
        $couple = new Couple($couple_id, $user1_id, $user2_id, date('Y-m-d H:i:s'));
        $couple->save();

        return $couple;
    }

    public function createCoupleFromUserId(int $user_id): Couple
    {
        Couple::validateUserId($user_id);
        return Couple::getCoupleByUserId($user_id);
    }
}
