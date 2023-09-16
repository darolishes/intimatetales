<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <header class="f-header hide-nav hide-nav--fixed js-hide-nav js-hide-nav--main js-f-header">
        <div class="f-header__mobile-content container max-width-lg">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="f-header__logo">
                <!-- SVG logo code here -->
            </a>
  
            <button class="reset anim-menu-btn js-anim-menu-btn js-tab-focus f-header__nav-control" aria-label="Toggle menu">
                <i class="anim-menu-btn__icon anim-menu-btn__icon--close" aria-hidden="true"></i>
            </button>
        </div>
  
        <div class="f-header__nav" role="navigation">
            <div class="f-header__nav-grid container max-width-lg">
                <div class="f-header__nav-logo-wrapper margin-right-lg@md">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="f-header__logo">
                        <!-- SVG logo code here -->
                    </a>
                </div>
                <ul class="f-header__list js-f-header__list">
                    <?php
                    wp_nav_menu( array(
                        'theme_location' => 'header-menu',
                        'container' => false,
                        'items_wrap' => '%3$s',
                        'walker' => new IT_Walker_Nav_Menu()
                    ) );
                    ?>
                </ul>