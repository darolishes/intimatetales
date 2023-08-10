<?php

namespace IntimateTales\User\Relationships;

use IntimateTales\User\User;
use IntimateTales\Couple\Couple;

class UserRelationships 
{
    public function __construct(private User $user) { }
    
    public function getCouples(): array {
        return $this->couples; 
    }
    
    public function addCouple(Couple $couple): void {
        $this->validateCouple($couple);
        $this->couples[] = $couple;
    }
  
    public function removeCouple(Couple $couple): void {
        $this->validateCouple($couple);
        $key = array_search($couple, $this->couples, true);
        unset($this->couples[$key]);
    }
    
    public function isCoupled(): bool {
        return !empty($this->couples);
    }
    
    public function getCurrentCouple(): ?Couple {
        return count($this->couples) === 1 ? 
               $this->couples[0] : 
               null;
    }
    
    private function validateCouple(Couple $couple): void {
        if (!$couple->includesUser($this->user)) {
            throw new Exception('Couple does not include this user.'); 
        }  
    }      
}