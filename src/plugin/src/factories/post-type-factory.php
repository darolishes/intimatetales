<?php

namespace IT\Factories;

use IT\Config\Config;
use IT\Models\PostType;

class PostTypeFactory
{
    public function make(string $name, Config $config)
    {
        return new $name($config->getArgs());
    }

    public function register(PostType $postType)
    {
        $postType->register();
    }
}
