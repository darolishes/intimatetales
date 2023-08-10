<?php

namespace IT\Models;

class User
{

  private $ID;
  private $username;
  private $email;

  public function __construct($ID)
  {
    $this->ID = $ID;
    $this->loadData();
  }

  private function loadData()
  {
    $user = get_user_by('id', $this->ID);
    $this->username = $user->user_login;
    $this->email = $user->user_email;
  }

  public function getID()
  {
    return $this->ID;
  }

  public function getUsername()
  {
    return $this->username;
  }

  public function getEmail()
  {
    return $this->email;
  }
}
