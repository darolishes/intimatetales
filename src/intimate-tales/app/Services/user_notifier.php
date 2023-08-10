<?php

namespace IT\Services;

use IT\Models\User;

interface UserNotifier
{

    // Einladungsbenachrichtigungen
    public function notifyInviteRequested( User $user );
    public function notifyInviteAccepted( User $user );
    public function notifyInviteRejected( User $user );

    // Passwortbenachrichtigungen
    public function notifyPasswordResetRequested( User $user );
    public function notifyPasswordChanged( User $user );

    // E-Mail-Benachrichtigungen
    public function notifyEmailChanged( User $user );
    public function notifyEmailVerified( User $user );
    public function notifyEmailSuspended( User $user );

    // Benutzerstatusbenachrichtigungen
    public function notifyUserCreated( User $user );
    public function notifyUserUpdated( User $user );
    public function notifyUserDeleted( User $user );
    public function notifyUserSuspended( User $user );

    // Rollen- und Berechtigungsbenachrichtigungen (optional, je nach Bedarf)
    public function notifyRoleCreated( User $user );
    public function notifyPermissionUpdated( User $user );
}
