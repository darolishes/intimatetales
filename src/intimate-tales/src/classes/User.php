<?php

namespace IntimateTales\Classes;

use IntimateTales\Classes\Views;

if (!defined('ABSPATH')) {
    exit;
}

class User
{
    const PARTNER_ID_META_KEY = 'it_partner_id';
    const STORIES_PLAYED = 'it_stories_played';

    private $user_id;
    private $partner_id;
    private $user_data;
    private $views;

    public function __construct($user_id = 0)
    {
        if (!$user_id) {
            $user_id = get_current_user_id();
        }

        $this->user_id      = $user_id;
        $this->views        = new Views();

        $this->partner_id   = $this->get_partner_id($user_id);
        $this->user_data    = $this->get_user_data($user_id);
    }

    public function get_user_id()
    {
        return $this->user_id;
    }

    public function get_partner_id($user_id = null)
    {
        if (empty($user_id)) {
            $user_id = $this->user_id;
        }

        return get_user_meta($user_id, self::PARTNER_ID_META_KEY, true);
    }

    public function get_user_data($user_id = null)
    {
        if (empty($user_id)) {
            $user_id = $this->user_id;
        }

        return get_userdata($user_id);
    }
}
