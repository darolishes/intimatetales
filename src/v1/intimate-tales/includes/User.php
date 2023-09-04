<?php

class User {
    private $user;

    public 
    /**
     * __Construct
     * 
     * This method handles __construct functionality for User.
     */
function __Construct($user_id = null) {
        if ($user_id) {
            $this->user = new WP_User($user_id);
        }