<?php

namespace IntimateTales\User;

class User
{
    private $actions;
    private $profile;
    private $relationships;

    public function __construct()
    {
        $this->actions = new Actions\UserActions();
        $this->profile = new Profile\UserProfile();
        $this->relationships = new Relationships\UserRelationships();
    }

    public function getActions(): Actions\UserActions
    {
        return $this->actions;
    }

    public function getProfile(): Profile\UserProfile
    {
        return $this->profile;
    }

    public function getRelationships(): Relationships\UserRelationships
    {
        return $this->relationships;
    }
}
