<?php

namespace IntimateTales\Services\Notifications;

use IntimateTales\Template_Loader;

defined( 'ABSPATH' ) || exit;

class Email_Notifier {

	protected $loader;
	protected $user;

	public function __construct( Template_Loader $loader, User $user ) {
		$this->loader = $loader;
		$this->user   = $user;

		$this->loader->load( 'emails' );
		$this->loader->load( 'emails/templates' );
		$this->loader->load( 'emails/partials' );
	}

	/**
	 * Send a notification based on the type.
	 */
	public function notify( string $type, User $user ) {
		$template_path = 'emails/' . str_replace( '_', '-', $type );
		$this->loader->load( $template_path );
	}
}
