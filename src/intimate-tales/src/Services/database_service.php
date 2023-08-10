<?php

namespace IT\Services;

class DatabaseService
{
  private $wpdb;
  private $inviteTableName;

  /**
   * DatabaseService constructor.
   * @param \wpdb $wpdb
   */
  public function __construct(\wpdb $wpdb)
  {
    $this->wpdb = $wpdb;
    $this->inviteTableName = $this->wpdb->prefix . 'invite';
  }

  public function getWpdb(): \wpdb
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
