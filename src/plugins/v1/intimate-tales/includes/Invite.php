<?php

class Invite {

	use InviteCommonMethods;
	use DatabaseTableCreator;

	private $recipientId;
	private $token;
	private $url;
	private $inviteTableName;
	private $databaseService;

	public 
    /**
     * __Construct
     * 
     * This method handles __construct functionality for Invite.
     */
function __Construct( string $token, int $recipientId, DatabaseService $databaseService ) {
		$this->recipientId     = $recipientId;
		$this->token           = $token;
		$this->url             = $this->generateUrl();
		$this->inviteTableName = $databaseService->getInviteTableName();
		$this->databaseService = $databaseService;

		$this->createTableIfNotExists( $this->inviteTableName, $this->getInviteTableSql() );
		$this->insertInvite();
	}