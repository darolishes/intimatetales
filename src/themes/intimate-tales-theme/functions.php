<?php
add_action('after_setup_theme', function()
{
    add_theme_support('soil', [
        'clean-up',
        'disable-rest-api',
        'disable-asset-versioning',
        'disable-trackbacks',
        'js-to-footer',
        'nav-walker',
        'nice-search',
        'relative-urls'
    ]);

    register_nav_menus(
        array(
            'primary-menu' => __('Header Menu')
        )
    );
});

add_action('wp_enqueue_scripts', 'intimate_tales_enqueue_styles_scripts');

function intimate_tales_enqueue_styles_scripts()
{
    wp_enqueue_style('intimate-tales-style', get_stylesheet_directory_uri() . '/assets/css/style.css');

    wp_enqueue_script('intimate-tales-color-theme', get_template_directory_uri() . '/assets/js/color-theme.js', array(), null, false);
    wp_enqueue_script('intimate-tales-scripts', get_stylesheet_directory_uri() . '/assets/js/scripts.min.js', array(), null, true);
}