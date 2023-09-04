<?php

namespace IntimateTales\Services\Notifications;

defined( 'ABSPATH' ) || exit;

interface User_Notifier {

	// Einladungsbenachrichtigungen
	public function NotifyInviteRequested( User $user);
	public function NotifyInviteAccepted( User $user);
	public function NotifyInviteRejected( User $user);

	// Passwortbenachrichtigungen
	public function NotifyPasswordResetRequested( User $user);
	public function NotifyPasswordChanged( User $user);

	// E-Mail-Benachrichtigungen
	public function NotifyEmailChanged( User $user);
	public function NotifyEmailVerified( User $user);
	public function NotifyEmailSuspended( User $user);

	// Benutzerstatusbenachrichtigungen
	public function NotifyUserCreated( User $user);
	public function NotifyUserUpdated( User $user);
	public function NotifyUserDeleted( User $user);
	public function NotifyUserSuspended( User $user);
}
