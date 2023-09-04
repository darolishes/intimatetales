<?php

class EmailNotifier {

	protected $loader;
	protected $user;

	public 
    /**
     * __Construct
     * 
     * This method handles __construct functionality for EmailNotifier.
     */
function __Construct( Template_Loader $loader, User $user ) {
		$this->loader = $loader;
		$this->user   = $user;

		$this->loader->load( 'emails' );
		$this->loader->load( 'emails/templates' );
		$this->loader->load( 'emails/partials' );
	}