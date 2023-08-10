<?php

namespace IntimateTales;

class SmsNotifier implements UserNotifier
{

    public function notify( User $user, string $template )
    {
        // Send SMS notification using $template content
    }
}
