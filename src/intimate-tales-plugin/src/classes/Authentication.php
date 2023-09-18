<?php

namespace IntimateTales\Classes;

use IntimateTales\Classes\Views;

if (!defined('ABSPATH')) {
    exit;
}

class Authentication
{

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $remember;

    /**
     * @var string
     */
    private $redirect;

    /**
     * @var string
     */
    private $error;

    public function __construct()
    {
        add_action('init', [$this, 'add_endpoints']);
        add_action('template_redirect', [$this, 'template_router']);

        $this->username = '';
        $this->password = '';
        $this->remember = '';
        $this->redirect = '';
        $this->error = '';

        if (isset($_GET['error'])) {
            $this->error = $_GET['error'];
        }
    }

    public function add_endpoints()
    {
        add_rewrite_endpoint('login', EP_ROOT | EP_PAGES);
        add_rewrite_endpoint('signup', EP_ROOT | EP_PAGES);
        add_rewrite_endpoint('forgot-password', EP_ROOT | EP_PAGES);
    }

    public function template_router()
    {
        global $wp_query;

        if (is_user_logged_in()) {
            return;
        }

        $views = Views::instance();

        $templates = [
            'login'             => 'loginForm',
            'signup'            => 'signupForm',
            'forgot-password'   => 'forgotPasswordForm'
        ];

        $args = ['redirect' => site_url($_SERVER['REQUEST_URI'])];

        foreach ($templates as $var => $name) {
            if (isset($wp_query->query_vars[$var])) {
                $views->part($name, $args, 'auth');
                exit;
            }
        }
    }
}
