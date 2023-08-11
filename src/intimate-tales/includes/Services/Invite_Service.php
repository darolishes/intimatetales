<?php

namespace IntimateTales\Services;

defined( 'ABSPATH' ) || exit;

use IntimateTales\Services\Email\Email_Notifier;

class Invite_Service {

	use Invite_Common_Methods;

	public const STATUS_ACCEPTED = 'accepted';
	public const STATUS_REJECTED = 'rejected';
	public const STATUS_PENDING  = 'pending';

	private $wpdb;
	private $email_notifier;

	public function __construct( wpdb $wpdb, Email_Notifier $email_notifier ) {
		$this->wpdb           = $wpdb;
		$this->email_notifier = $email_notifier;
	}

	public function register_invite_service() {
		// Register hooks for invite service
		add_action( 'init', array( $this, 'handle_inviteRedirect' ) );
	}

	public function handle_inviteRedirect() {
		if ( isset( $_GET['invite_token'] ) ) {
			$inviteToken = sanitize_text_field( $_GET['invite_token'] );
			$invite      = $this->getInviteByToken( $inviteToken );

			if ( $invite ) {
				$this->handle_invite( $invite );
			}
		}
	}

	public function handle_invite( $invite ) {
		if ( $invite->status == self::STATUS_PENDING ) {
			$this->accept_invite( $invite );
		} elseif ( $invite->status == self::STATUS_REJECTED ) {
			$this->reject_invite( $invite );
		}
	}

	public function accept_invite( $invite ) {
		$invite->status = self::STATUS_ACCEPTED;
		$this->update_invite_status( $invite->id, self::STATUS_ACCEPTED );
		$this->email_notifier->send_invite_accepted_email( $invite );
	}

	public function redirect( $invite ) {
		// Redirect logic or actions based on the invite
		// For example: redirect to a specific page or perform some actions
		if (
			$invite->status == self::STATUS_ACCEPTED ||
			$invite->status == self::STATUS_REJECTED ||
			$invite->status == self::STATUS_PENDING
		) {
			$this->redirect_to_page( $invite );
		}
	}

	public function notifyAllPendingInvites() {
		$inviteTableName = $this->wpdb->prefix . 'invite';
		$query           = $this->wpdb->prepare( "SELECT * FROM {$inviteTableName} WHERE status IS NULL" );
		$invites         = $this->wpdb->get_results( $query, ARRAY_A );

		foreach ( $invites as $invite ) {
			$this->email_notifier->send_invite_notification( $invite['recipient_id'], $invite['url'] );
			$this->update_invite_status( $invite['id'], 'notified' );
		}
	}

	private function update_invite_status( $inviteId, $status ) {
		$inviteTableName = $this->wpdb->prefix . 'invite';
		$this->wpdb->update(
			$inviteTableName,
			array( 'status' => $status ),
			array( 'id' => $inviteId ),
			array( '%s' ),
			array( '%d' )
		);
	}

	// ... rest of the methods
}
