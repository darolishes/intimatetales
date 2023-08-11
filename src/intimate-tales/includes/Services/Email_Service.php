<?php

namespace IntimateTales\Services;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Email_Service {

    private $twig;

    public function __construct() {
        $loader     = new FilesystemLoader(plugin_dir_path(__FILE__) . '../templates/');
        $this->twig = new Environment($loader);
    }

    /**
     * Sends a password reset email to the user.
     * 
     * @param WP_User $user
     * @param string $reset_key
     */
    public function send_password_reset_email($user, $reset_key) {
        $subject = 'Password Reset Request';

        $message = $this->twig->render('password-reset-email.html.twig', [
            'user_display_name' => $user->display_name,
            'user_login'        => $user->user_login,
            'reset_key'         => $reset_key,
            'site_url'          => get_site_url(),
            'site_name'         => get_bloginfo('name')
        ]);

        wp_mail($user->user_email, $subject, $message);
    }
}
