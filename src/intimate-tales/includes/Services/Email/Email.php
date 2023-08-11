<?php

namespace IntimateTales\Services\Email;

defined( 'ABSPATH' ) || exit;

class Email implements Email_Template {

	protected $loader;
	protected $user;

	public function __construct( User $user ) {
		$this->user = $user;
	}

	/**
	 * @return array
	 */
	protected function get_mail_headers() {
		return array(
			'From'     => $this->get_from(),
			'Reply-To' => $this->get_reply_to(),
		);
	}

	public function get_subject(): string {
		return 'Welcome ..';
	}

	public function get_body(): string {
		return $this->loader->render_template( 'emails.welcome', array( 'user' => $this->user ) );
	}

	public function get_to(): string {
		return '';
	}

	public function get_from(): string {
		return '';
	}

	public function get_reply_to(): string {
		return '';
	}

	public function get_loader(): Template_Loader_Interface {
		return $this->loader;
	}

	public function send() {
		wp_mail(
			$this->get_to(),
			$this->get_subject(),
			$this->get_body(),
			$this->get_mail_headers()
		);
	}
}
