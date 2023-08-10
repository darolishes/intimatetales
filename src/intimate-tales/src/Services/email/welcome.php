<?php

namespace IT\Services;

use IT\Services\Email\Email;
use IT\Interfaces\TemplateLoaderInterface;

class WelcomeEmail extends Email
{
    /**
     * WelcomeEmail constructor.
     */
    public function __construct($user, TemplateLoaderInterface $loader)
    {
        parent::__construct($user, $loader);
    }

    public function getSubject(): string
    {
        // Replace with your own logic or configuration retrieval method
        return 'Welcome to ' . get_option('blogname');
    }

    public function getBody(): string
    {
        // Use the loader to render the template
        return $this->loader->renderTemplate('emails.welcome', ['user' => $this->user]);
    }

    public function getFrom(): string
    {
        // Replace with your own logic or configuration retrieval method
        return get_option('admin_email');
    }
}