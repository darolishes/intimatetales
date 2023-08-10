<?php

namespace IT\Services\Email;

use IT\Models\User;
use IT\Interfaces\EmailTemplate;
use IT\Interfaces\TemplateLoaderInterface;

class Email implements EmailTemplate
{
    protected $loader;
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return array
     */
    protected function getMailHeaders()
    {
        return [
            'From' => $this->getFrom(),
            'Reply-To' => $this->getReplyTo()
        ];
    }

    /**
     * @return string
     */
    public function getSubject(): string
    {
        return 'Welcome ..';
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->loader->renderTemplate('emails.welcome', ['user' => $this->user]);
    }

    /**
     * @return string
     */
    public function getTo(): string
    {
        return '';
    }

    /**
     * @return string
     */
    public function getFrom(): string
    {
        return '';
    }

    /**
     * @return string
     */
    public function getReplyTo(): string
    {
        return '';
    }

    /**
     * @return TemplateLoaderInterface
     */
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
