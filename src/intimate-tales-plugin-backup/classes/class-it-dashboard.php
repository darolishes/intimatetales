<?php

/**
 * IntimateTales Dashboard Class
 */

if (!defined('ABSPATH')) {
    exit;
}

class IntimateTales_Dashboard
{
    private $mainClassInstance;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->mainClassInstance = new IntimateTales();

        add_shortcode('intimate_user_dashboard', array($this, 'render_user_dashboard'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_dashboard_assets'));

        // Add hooks for user activities and stories.
        add_action('intimate_display_user_activities', array($this, 'display_user_activities'));
        add_action('intimate_display_user_stories', array($this, 'display_user_stories'));
    }

    /**
     * Enqueue dashboard specific scripts and styles.
     */
    public function enqueue_dashboard_assets()
    {
        if (is_page('dashboard')) {
            wp_enqueue_style(INTIMATE_TALES_ENQUEUE_PREFIX . 'dashboard_style', INTIMATE_TALES_PLUGIN_URL . 'assets/scss/dashboard.scss', array(), INTIMATE_TALES_VERSION);
            wp_enqueue_script(INTIMATE_TALES_ENQUEUE_PREFIX . 'dashboard_script', INTIMATE_TALES_PLUGIN_URL . 'assets/js/dashboard.js', array('jquery'), INTIMATE_TALES_VERSION, true);
        }
    }

    /**
     * Render the user dashboard.
     */
    public function render_user_dashboard()
    {
        return $this->mainClassInstance->load_template('user-dashboard');
    }

    /**
     * Display user activities on the dashboard.
     *
     * @param int $user_id User ID.
     */
    public function display_user_activities($user_id)
    {
        echo '<div class="intimate-dashboard-activities">';
        echo '<h3>' . __('Your Recent Activities', INTIMATE_TALES_TEXTDOMAIN) . '</h3>';

        // Fetch user activities logic here.
        $activities = get_user_meta($user_id, 'intimate_user_activities', true);
        if (!empty($activities)) {
            echo '<ul>';
            foreach ($activities as $activity) {
                echo '<li>' . esc_html($activity) . '</li>';
            }
            echo '</ul>';
        } else {
            echo '<p>' . __('No recent activities found.', INTIMATE_TALES_TEXTDOMAIN) . '</p>';
        }

        echo '</div>';
    }

    /**
     * Display user stories on the dashboard.
     *
     * @param int $user_id User ID.
     */
    public function display_user_stories($user_id)
    {
        echo '<div class="intimate-dashboard-stories">';
        echo '<h3>' . __('Your Stories', INTIMATE_TALES_TEXTDOMAIN) . '</h3>';

        // Fetch user stories logic here.
        $args = array(
            'post_type' => INTIMATE_TALES_STORY_POST_TYPE,
            'author'    => $user_id,
            'posts_per_page' => 5,
        );
        $user_stories = new WP_Query($args);
        if ($user_stories->have_posts()) {
            echo '<ul>';
            while ($user_stories->have_posts()) {
                $user_stories->the_post();
                echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
            }
            wp_reset_postdata();
            echo '</ul>';
        } else {
            echo '<p>' . __('No stories found.', INTIMATE_TALES_TEXTDOMAIN) . '</p>';
        }

        echo '</div>';
    }
}

// Initialize the dashboard class.
new IntimateTales_Dashboard();
