<?php

namespace IT\Services\Email;

use IT\Models\User;
use IT\Loaders\TemplateLoader;

class EmailNotifier
{
  protected $loader;
  protected $user;

  public function __construct(TemplateLoader $loader, User $user)
  {
    $this->loader = $loader;
    $this->user = $user;

    $this->loader->load('emails');
    $this->loader->load('emails/templates');
    $this->loader->load('emails/partials');
  }

  /**
   * Send a notification based on the type.
   *
   * @param string $type
   * @param User $user
   */
  public function notify(string $type, User $user)
  {
    $templatePath = 'emails/' . str_replace('_', '-', $type);
    $this->loader->load($templatePath);
  }
}
