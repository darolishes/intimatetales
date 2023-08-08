<?php

namespace IntimateTales\User;

use IntimateTales\User\Actions\UserActions;
use IntimateTales\User\Profile\UserProfile;
use IntimateTales\User\Relationships\UserRelationships;

/**
 * Represents a User within the IntimateTales system.
 */
class User
{
    private $actions;
    private $profile;
    private $relationships;

    /**
     * User constructor.
     *
     * @param UserActions $actions User actions handler.
     * @param UserProfile $profile User profile handler.
     * @param UserRelationships $relationships User relationships handler.
     */
    public function __construct(UserActions $actions, UserProfile $profile, UserRelationships $relationships)
    {
        $this->actions = $actions;
        $this->profile = $profile;
        $this->relationships = $relationships;
    }

    /**
     * Get the user actions handler.
     *
     * @return UserActions
     */
    public function getActions(): UserActions
    {
        return $this->actions;
    }

    /**
     * Get the user profile handler.
     *
     * @return UserProfile
     */
    public function getProfile(): UserProfile
    {
        return $this->profile;
    }

    /**
     * Get the user relationships handler.
     *
     * @return UserRelationships
     */
    public function getRelationships(): UserRelationships
    {
        return $this->relationships;
    }

    /**
     * Save additional information for the user.
     */
    public function saveAdditionalInformation()
    {
        $this->actions->save();
        $this->profile->save();
        $this->relationships->save();
    }
}