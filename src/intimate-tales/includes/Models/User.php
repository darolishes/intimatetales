<?php

namespace IntimateTales\Models;

use IntimateTales\Template_Loader;
use WP_User;

class User {
    private $user;

    public function __construct($user_id = null) {
        if ($user_id) {
            $this->user = new WP_User($user_id);
        } else {
            $this->user = wp_get_current_user();
        }
    }

    public function get_id() {
        return $this->user->ID;
    }

    public function get_display_name() {
        return $this->user->display_name;
    }

    public function is_logged_in() {
        return is_user_logged_in();
    }

    public function show_login_form() {
        $template_loader = new Template_Loader();
        $data = array(
            'login_url' => wp_login_url(),
            'redirect_url' => home_url()
        );
        $template_loader->load_template('login-form', $data);
    }

    public function show_registration_form() {
        // Ähnliche Methode wie `show_login_form` aber für Registrierung
    }

    public function show_forgot_password_form() {
        // Ähnliche Methode wie `show_login_form` aber für Passwort vergessen
    }
}
