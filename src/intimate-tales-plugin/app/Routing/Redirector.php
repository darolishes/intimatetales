<?php

namespace IntimateTales\Routing;

class Redirector
{
    protected $routes = [
        'home'                  => '/',
        'login'                 => '/login',
        'register'              => '/register',
        'register.success'      => '/',
        'logout'                => '/logout',
        'password'              => '/password',
        'password.success'      => '/',
        'onboard'               => '/onboard',
        'profile'                => '/profile',
        'profile/edit'           => '/profile/edit',
        'profile/edit/password'  => '/profile/edit/password',
        'profile/dashboard'      => '/profile/dashboard',
    ];

    public function to($name)
    {
        $url = $this->to_url($name);

        if ($url !== null) {
            $this->redirect($url);
        }

        return false;
    }

    protected function to_url($name)
    {
        $path = $this->routes[$name] ?? null;

        if ($path !== null) {
            return home_url($path);
        }

        return null;
    }

    protected function redirect($url)
    {
        wp_redirect($url);
        exit;
    }
}
