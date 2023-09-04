<?php

class InviteService {

	use Invite_Common_Methods;

	public const STATUS_ACCEPTED = 'accepted';
	public const STATUS_REJECTED = 'rejected';
	public const STATUS_PENDING  = 'pending';

	private $wpdb;
	private $email_notifier;

	public 
    /**
     * __Construct
     * 
     * This method handles __construct functionality for InviteService.
     */
function __Construct( wpdb $wpdb, Email_Notifier $email_notifier ) {
		$this->wpdb           = $wpdb;
		$this->email_notifier = $email_notifier;
	}