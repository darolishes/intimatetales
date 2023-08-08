<?php

namespace IntimateTales\User\Relationships;

use IntimateTales\User\User;

/**
 * Represents user relationships and couples.
 */
class UserRelationships
{
    /**
     * @var User The user for whom relationships are managed.
     */
    private $user;

    /**
     * @var array Array of couples.
     */
    private $couples;

    /**
     * UserRelationships constructor.
     *
     * @param User $user The user for whom relationships are managed.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->couples = [];
    }

    /**
     * Get the array of couples.
     *
     * @return array Array of couples.
     */
    public function getCouples(): array
    {
        return $this->couples;
    }

    /**
     * Add a couple to the list.
     *
     * @param Couple $couple The couple to add.
     */
    public function addCouple(Couple $couple)
    {
        $this->couples[] = $couple;
    }

    /**
     * Remove a couple from the list.
     *
     * @param Couple $couple The couple to remove.
     */
    public function removeCouple(Couple $couple)
    {
        $index = array_search($couple, $this->couples, true);
        if ($index !== false) {
            unset($this->couples[$index]);
        }
    }
}