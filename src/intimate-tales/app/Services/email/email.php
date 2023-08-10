<?php

namespace IT\Services\Email;

use IT\Interfaces\EmailTemplate;
use IT\Interfaces\TemplateLoaderInterface;
use IT\Models\User;

class Email implements EmailTemplate
{

    protected $loader;
    protected $user;

    public function __construct( User $user )
    {
        $this->user = $user;
    }

    /**
     * @return array
     */
    protected function getMailHeaders()
    {
        return [
            'From'     => $this->getFrom(),
            'Reply-To' => $this->getReplyTo(),
        ];
    }

    public function getSubject(): string
    {
        return 'Welcome ..';
    }

    public function getBody(): string
    {
        return $this->loader->renderTemplate( 'emails.welcome', ['user' => $this->user] );
    }

    public function getTo(): string
    {
        return '';
    }

    public function getFrom(): string
    {
        return '';
    }

    public function getReplyTo(): string
    {
        return '';
    }

    public function getLoader(): TemplateLoaderInterface
    {
        return $this->loader;
    }

    public function send()
    {
        wp_mail(
            $this->getTo(),
            $this->getSubject(),
            $this->getBody(),
            $this->getMailHeaders()
        );
    }
}
