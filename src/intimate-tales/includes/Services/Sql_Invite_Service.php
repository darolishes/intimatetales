<?php

namespace IntimateTales\Services;

defined( 'ABSPATH' ) || exit;

class Sql_Invite_Service {

	public function get_invite_token() {
		// Token generieren
		return $token;
	}

	public function get_invites( int $limit, int $offset ) {
		$sql = "SELECT * FROM {$this->db->prefix}invites LIMIT %d, %d";

		return $this->db->query( $sql, array( $limit, $offset ) );
	}

	public function create_invite( int $recipientId ) {
		$token = $this->get_invite_token();

		$sql = "INSERT INTO {$this->db->prefix}invites 
            (token, recipient_id) 
            VALUES (%s, %d)";

		$this->db->query( $sql, array( $token, $recipientId ) );
	}
}
