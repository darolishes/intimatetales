<?php

namespace IntimateTales\Interfaces;

interface Email_Template {

	public function get_subject(): string;
	public function get_body(): string;
	public function get_to(): string;
	public function get_from(): string;
	public function get_reply_to(): string;
}
