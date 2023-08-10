<?php

namespace IT\Services;

use wpdb;

class DatabaseService
{

    private $wpdb;
    private $inviteTableName;

    /**
     * DatabaseService constructor.
     */
    public function __construct( wpdb $wpdb )
    {
        $this->wpdb            = $wpdb;
        $this->inviteTableName = $this->wpdb->prefix . 'invite';
    }

    public function getWpdb(): wpdb
    {
        return $this->wpdb;
    }

    public function getInviteTableName(): string
    {
        return $this->inviteTableName;
    }

    public function getCharsetCollate()
    {
        return $this->wpdb->get_charset_collate();
    }
}
