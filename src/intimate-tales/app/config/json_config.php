<?php

namespace IT\JsonConfig;

use Exception;
use IT\Config\Config;

class JsonConfig extends Config
{

    private $json;

    public function __construct( $json )
    {
        $this->json = json_decode( $json, true );
        // Decode and validate JSON
        if ( json_last_error() !== JSON_ERROR_NONE ) {
            throw new Exception( 'Invalid JSON' );
        }
    }

    private function validateJSON()
    {
        $required = ['name', 'labels' => ['name']];

        foreach ( $required as $key => $val ) {
            if ( is_array( $val ) ) {
                // Validate nested array
                $this->validateNestedArray( $val );
            } else {
                if ( empty( $this->json[$key] ) ) {
                    throw new InvalidConfigException( "'$key' is required" );
                }
            }
        }
    }

    private function validateNestedArray( array $keys )
    {
        foreach ( $keys as $key ) {
            if ( empty( $this->json['labels'][$key] ) ) {
                throw new InvalidConfigException( "'$key' under 'labels' is required" );
            }
        }
    }

    public function getArgs()
    {
        return $this->json;
    }
}
