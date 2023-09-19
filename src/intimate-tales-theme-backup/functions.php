<?php
require_once 'includes/IT_Walker_Nav_Menu.php';

add_action('after_setup_theme', 'intimate_tales_register_nav_menu');
add_action('wp_enqueue_scripts', 'intimate_tales_enqueue_styles_scripts');

function intimate_tales_enqueue_styles_scripts()
{
    wp_enqueue_style('intimate-tales-style', get_stylesheet_directory_uri() . '/assets/css/style.min.css');

    #wp_enqueue_script('intimate-tales-color-theme', get_template_directory_uri() . '/assets/js/color-theme.js', array(), null, true);
    wp_enqueue_script('intimate-tales-scripts', get_stylesheet_directory_uri() . '/assets/js/scripts.min.js', array('jquery'), null, true);
}

function intimate_tales_register_nav_menu()
{
    register_nav_menus(
        array(
            'header-menu' => __('Header Menu')
        )
    );
}
