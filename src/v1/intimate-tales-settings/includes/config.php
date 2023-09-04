
<?php
/**
 * Configuration Manager for Intimate Tales - Settings Plugin
 */

namespace IntimateTales;

defined( 'ABSPATH' ) || exit;

class Config {

    /**
     * @var array
     */
    private array $settings;

    /**
     * Config constructor.
     */
    public function __construct() {
        $this->settings = get_option( 'intimate_tales_settings', array() );
    }

    /**
     * Get a specific configuration key.
     *
     * @param string $key
     * @return mixed
     */
    public function get( string $key ): mixed {
        return get_field( $key, 'option' ) ?: null;
    }

    /**
     * Set a specific configuration key.
     *
     * @param string $key
     * @param mixed $value
     */
    public function set( string $key, mixed $value ): void {
        update_field( $key, $value, 'option' );
    }
}
