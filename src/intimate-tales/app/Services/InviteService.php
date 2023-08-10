<?php

namespace IT\Models;

use IT\Services\Email\EmailNotifier;
use IT\Traits\InviteCommonMethods;
use wpdb;

class InviteService
{

    use InviteCommonMethods;

    public const STATUS_ACCEPTED = 'accepted';
    public const STATUS_REJECTED = 'rejected';
    public const STATUS_PENDING  = 'pending';

    private $wpdb;
    private $emailNotifier;

    public function __construct( wpdb $wpdb, EmailNotifier $emailNotifier )
    {
        $this->wpdb          = $wpdb;
        $this->emailNotifier = $emailNotifier;
    }

    public function registerInviteService()
    {
        // Register hooks for invite service
        add_action( 'init', [$this, 'handleInviteRedirect'] );
    }

    public function handleInviteRedirect()
    {
        if ( isset( $_GET['invite_token'] ) ) {
            $inviteToken = sanitize_text_field( $_GET['invite_token'] );
            $invite      = $this->getInviteByToken( $inviteToken );

            if ( $invite ) {
                $this->handleInvite( $invite );
            }
        }
    }

    public function handleInvite( $invite )
    {
        if ( $invite->status == self::STATUS_PENDING ) {
            $this->acceptInvite( $invite );
        } elseif ( $invite->status == self::STATUS_REJECTED ) {
            $this->rejectInvite( $invite );
        }
    }

    public function acceptInvite( $invite )
    {
        $invite->status = self::STATUS_ACCEPTED;
        $this->updateInviteStatus( $invite->id, self::STATUS_ACCEPTED );
        $this->emailNotifier->sendInviteAcceptedEmail( $invite );
    }

    public function redirect( $invite )
    {
        // Redirect logic or actions based on the invite
        // For example: redirect to a specific page or perform some actions
        if ( $invite->status == self::STATUS_ACCEPTED ||
        $invite->status == self::STATUS_REJECTED ||
        $invite->status == self::STATUS_PENDING
        ) {
            $this->redirectToPage( $invite );
        }
    }

    public function notifyAllPendingInvites()
    {
        $inviteTableName = $this->wpdb->prefix . 'invite';
        $query           = $this->wpdb->prepare( "SELECT * FROM {$inviteTableName} WHERE status IS NULL" );
        $invites         = $this->wpdb->get_results( $query, ARRAY_A );

        foreach ( $invites as $invite ) {
            $this->emailNotifier->sendInviteNotification( $invite['recipient_id'], $invite['url'] );
            $this->updateInviteStatus( $invite['id'], 'notified' );
        }
    }

    private function updateInviteStatus( $inviteId, $status )
    {
        $inviteTableName = $this->wpdb->prefix . 'invite';
        $this->wpdb->update(
            $inviteTableName,
            ['status' => $status],
            ['id'     => $inviteId],
            ['%s'],
            ['%d']
        );
    }

    // ... rest of the methods
}
