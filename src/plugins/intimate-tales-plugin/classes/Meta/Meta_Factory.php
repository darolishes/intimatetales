<?php

namespace IntimateTales\Meta;

use IntimateTales\Meta\Providers\ACF_Provider;
use IntimateTales\Meta\Providers\WP_Provider;
use IntimateTales\Meta\Providers\DB_Provider;

class Meta_Factory 
{

    /**
     * Erstellt und gibt eine Instanz des angeforderten MetaProviders zurück.
     *
     * @param string $type Der gewünschte MetaProvider-Typ (z.B. 'acf', 'wp', 'custom_db').
     * @return \IntimateTales\Meta\Providers\Meta_Provider_Interface Eine Instanz des MetaProviders.
     */
    public static function create($type = 'wp') {
        switch ($type) {
            case 'acf':
                return new ACF_Provider();
            case 'custom_db':
                return new DB_Provider();
            case 'wp':
            default:
                return new WP_Provider();
        }
    }
}
