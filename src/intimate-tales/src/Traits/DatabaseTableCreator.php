<?php

namespace IT\Traits;

trait DatabaseTableCreator
{
    protected $databaseService;

    public function __construct(\IT\Services\DatabaseService $databaseService)
    {
        $this->databaseService = $databaseService;
    }

    public function createTableIfNotExists($tableName, $sql)
    {
        require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        $charsetCollate = $this->databaseService->getCharsetCollate();

        $query = "CREATE TABLE IF NOT EXISTS `{$tableName}` (
            {$sql}
        ) {$charsetCollate};";

        dbDelta($query);
    }
}
