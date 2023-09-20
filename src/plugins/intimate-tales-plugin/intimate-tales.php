<?php

/**
 * Plugin Name:        Intimate Tales
 * Plugin URI:         https://intimate-tales.com/
 * Description:        
 * Version:            1.0.0
 * Author:             Dawid Rogaczewski
 * Author URI:         https://intimate-tales.com/
 * Primary Branch:     master
 */

if ( defined( 'ABSPATH' ) ) {
	if ( defined( 'VENDOR_DIR' ) ) {
		/** @psalm-suppress UnresolvableInclude, MixedOperand */
		require constant( 'VENDOR_DIR' ) . '/autoload.php';
	} elseif ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
		require __DIR__ . '/vendor/autoload.php';
	} elseif ( file_exists( ABSPATH . 'vendor/autoload.php' ) ) {
		/** @psalm-suppress UnresolvableInclude */
		require ABSPATH . 'vendor/autoload.php';
	}

	IntimateTales\Plugin::instance();
}
