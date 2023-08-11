<?php

namespace IntimateTales\Services\Notifications;

defined( 'ABSPATH' ) || exit;

interface User_Notifier {

	// Einladungsbenachrichtigungen
	public function notify_invite_requested( User $user);
	public function notify_invite_accepted( User $user);
	public function notify_invite_rejected( User $user);

	// Passwortbenachrichtigungen
	public function notify_password_reset_requested( User $user);
	public function notify_password_changed( User $user);

	// E-Mail-Benachrichtigungen
	public function notify_email_changed( User $user);
	public function notify_email_verified( User $user);
	public function notify_email_suspended( User $user);

	// Benutzerstatusbenachrichtigungen
	public function notify_user_created( User $user);
	public function notify_user_updated( User $user);
	public function notify_user_deleted( User $user);
	public function notify_user_suspended( User $user);
}
