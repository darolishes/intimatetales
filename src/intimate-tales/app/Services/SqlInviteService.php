<?php

namespace IntimateTales;

class SqlInviteService
{

    public function getInviteToken()
    {
        // Token generieren
        return $token;
    }

    public function getInvites( int $limit, int $offset )
    {
        $sql = "SELECT * FROM {$this->db->prefix}invites LIMIT %d, %d";

        return $this->db->query( $sql, [$limit, $offset] );
    }

    public function createInvite( int $recipientId )
    {
        $token = $this->getInviteToken();

        $sql = "INSERT INTO {$this->db->prefix}invites 
            (token, recipient_id) 
            VALUES (%s, %d)";

        $this->db->query( $sql, [$token, $recipientId] );
    }
}
