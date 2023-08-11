<?php

namespace IntimateTales\Factories;

defined( 'ABSPATH' ) || exit;

use IntimateTales\Config\Config;

class PostTypeFactory {


	public function make( string $name, Config $config ) {
		return new $name( $config->getArgs() );
	}

	public function register( PostType $postType ) {
		$postType->register();
	}
}
