<?php

namespace IT\Interfaces;

interface PostTypeInterface
{
    public function __construct(array $args);
    public function registerPostType();
}
