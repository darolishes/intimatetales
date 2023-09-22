<?php

class EmailService {

    private $twig;

    public 
    /**
     * __Construct
     * 
     * This method handles __construct functionality for EmailService.
     */
function __Construct() {
        $loader     = new FilesystemLoader(plugin_dir_path(__FILE__) . '../templates/');
        $this->twig = new Environment($loader);
    }