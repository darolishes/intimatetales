<?php

namespace IntimateTales\Services\Notifications;

defined( 'ABSPATH' ) || exit;

class Sms_Notifier implements User_Notifier {


	public function notify( User $user, string $template ) {
		// Send SMS notification using $template content
	}
}
