<?php

namespace IT\Models;

use IT\Services\DatabaseService;
use IT\Traits\DatabaseTableCreator;
use IT\Traits\InviteCommonMethods;

class Invite
{

    use InviteCommonMethods;
    use DatabaseTableCreator;

    private $recipientId;
    private $token;
    private $url;
    private $inviteTableName;
    private $databaseService;

    public function __construct( string $token, int $recipientId, DatabaseService $databaseService )
    {
        $this->recipientId     = $recipientId;
        $this->token           = $token;
        $this->url             = $this->generateUrl();
        $this->inviteTableName = $databaseService->getInviteTableName();
        $this->databaseService = $databaseService;

        $this->createTableIfNotExists( $this->inviteTableName, $this->getInviteTableSql() );
        $this->insertInvite();
    }

    private function getInviteTableSql()
    {
        return '
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `token` varchar(255) NOT NULL,
            `recipient_id` int(11) NOT NULL,
            `url` varchar(255) NOT NULL,
            `message` varchar(255) DEFAULT NULL,
            `status` varchar(255) DEFAULT NULL,
            `created_at` datetime NOT NULL,
            `updated_at` datetime NOT NULL,
            PRIMARY KEY (`id`)
        ';
    }

    private function insertInvite()
    {
        $data = [
            'token'        => $this->token,
            'recipient_id' => $this->recipientId,
            'url'          => $this->url,
        ];

        $this->insertData( $this->inviteTableName, $data );
    }
}
