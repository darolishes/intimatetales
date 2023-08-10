<?php

namespace IT\Models\PostTypes;

class PostType
{

    private $config;

    public function __construct( $config )
    {
        $this->config = $config;
    }

    public function registerPostType()
    {
        register_post_type( $this->config['name'], $this->config );
    }
}
