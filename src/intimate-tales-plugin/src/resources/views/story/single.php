<?php

/**
 * The template for displaying all single stories
 *
 * @package WordPress
 * @subpackage IntimateTales
 */

get_header();

while (have_posts()) :
    the_post();
    $story_data = get_post_meta(get_the_ID(), 'story_data', true);
?>
    <div id="story-container">
        <h1><?php the_title(); ?></h1>
        <p><?php echo esc_html($story_data['short_description']); ?></p>
        <p><?php echo esc_html($story_data['narrative_style']); ?></p>
        <p><?php echo esc_html($story_data['sharpness_level']); ?></p>
        <p><?php echo esc_html($story_data['experience_level']); ?></p>
        <div><?php the_content(); ?></div>
    </div>
<?php
endwhile;

get_footer();
