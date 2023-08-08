<?php

namespace IntimateTales\User\Profile;

use WP_User;

class UserProfile 
{
    private $user;
    private $preferences;

    public function __construct(WP_User $user) 
    {
        $this->validateUser($user);
        $this->user = $user;  
        $this->preferences = new UserPreferences($user);
    }
  
    public function getDisplayName(): string
    {
        return $this->user->display_name;
    }
    
    public function setDisplayName(string $displayName): void 
    {
        $this->validateDisplayName($displayName);
        $this->updateUser(['display_name' => $displayName]);
    }
    
    public function getEmail(): string 
    {
        return $this->user->user_email;
    }
    
    public function setEmail(string $email): void 
    {
        $this->validateEmail($email);
        $this->updateUser(['user_email' => $email]);
    }    
    
    public function getPreferences(): UserPreferences 
    {
        return $this->preferences;
    }    
    
    public function updatePreferences(array $newPreferences): void
    {
        $this->preferences->setPreferences($this->user->ID, $newPreferences);  
    }
    
    private function validateUser(WP_User $user) {
        if (empty($user->ID)) {
          throw new \InvalidArgumentException('Invalid user.');
        } 
      }
    
      private function validateDisplayName(string $displayName) {
        if (empty($displayName)) {
          throw new \InvalidArgumentException('Display name cannot be empty.');
        }  
        if (strlen($displayName) > 60) {
          throw new \InvalidArgumentException('Display name is too long.');  
        }
        $displayName = sanitize_text_field($displayName);
      }  
       
      private function validateEmail(string $email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          throw new \InvalidArgumentException('Invalid email format.');  
        }
        $email = sanitize_email($email);
      }
        
    private function updateUser(array $data): void {
       wp_update_user(['ID' => $this->user->ID, ...$data]);       
    }
}