<?php

namespace IT\Models\User;

class Couple
{

    public const CREATION_DATE_KEY = 'couple_creation_date';

    private $relationshipPost;

    private $partner1;
    private $partner2;

    public function __construct( int $user1Id, int $user2Id )
    {
        $this->create( $user1Id, $user2Id );
    }

    public function getPartner1(): CouplePartner
    {
        return $this->partner1;
    }

    public function getPartner2(): CouplePartner
    {
        return $this->partner2;
    }

    private function create( int $user1Id, int $user2Id ): void
    {
        // Create Relationship post
        //$this->relationshipPost = new RelationshipPost($user1Id, $user2Id);
        //$this->relationshipPost->save();

        // Create Couple Partners
        $this->partner1 = new CouplePartner( $user1Id, $this->relationshipPost->getId() );
        $this->partner2 = new CouplePartner( $user2Id, $this->relationshipPost->getId() );

        $this->partner1->save();
        $this->partner2->save();
    }

    public function isDissolved(): bool
    {
        return !$this->relationshipPost;
    }

    public function dissolve(): void
    {
        wp_delete_post( $this->relationshipPost->ID, true );
    }
}
