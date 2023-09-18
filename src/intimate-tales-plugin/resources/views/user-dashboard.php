<?php
/**
 * IntimateTales User Dashboard Template
 */

$current_user = wp_get_current_user();
if (!$current_user->ID) {
    echo '<p>' . __('You need to be logged in to view your dashboard.', INTIMATE_TALES_TEXTDOMAIN) . '</p>';
    return;
}

echo '<div class="intimate-dashboard-container">';
echo '<h2>' . __('Welcome to your dashboard', INTIMATE_TALES_TEXTDOMAIN) . ', ' . esc_html($current_user->display_name) . '!</h2>';

// Display user activities
do_action('intimate_display_user_activities', $current_user->ID);

// Display user stories
do_action('intimate_display_user_stories', $current_user->ID);

echo '</div>';
