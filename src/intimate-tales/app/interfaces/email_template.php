<?php

namespace IT\Interfaces;

interface EmailTemplate
{

    public function getSubject(): string;
    public function getBody(): string;
    public function getTo(): string;
    public function getFrom(): string;
    public function getReplyTo(): string;
}
