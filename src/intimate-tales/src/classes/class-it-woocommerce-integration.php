<?php

namespace IntimateTales\classes;

/**
 * WooCommerce Integration for Intimate Tales Plugin
 *
 * This class handles all the integration aspects related to WooCommerce for our custom functionalities.
 * It will connect our story content with WooCommerce products, allowing users to purchase premium stories, access passes, and memberships.
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class IT_WooCommerce_Integration
{

    /**
     * The single instance of the class.
     *
     * @var IT_WooCommerce_Integration
     */
    protected static $_instance = null;

    /**
     * Main IT_WooCommerce_Integration Instance.
     *
     * Ensures only one instance of IT_WooCommerce_Integration is loaded.
     *
     * @return IT_WooCommerce_Integration - Main instance.
     */
    public static function instance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Constructor.
     */
    public function __construct()
    {
        // Register WooCommerce hooks
        add_action('woocommerce_init', array($this, 'setup_integration_hooks'));
    }

    /**
     * Set up integration hooks for WooCommerce functionalities.
     */
    public function setup_integration_hooks()
    {
        // Hooks related to premium story purchase
        add_action('woocommerce_after_single_product', array($this, 'display_premium_story_content'));

        // Hooks for custom product variation options
        add_filter('woocommerce_product_data_tabs', array($this, 'add_story_variation_tabs'));

        // Hooks for user dashboard integration
        add_action('woocommerce_account_dashboard', array($this, 'display_user_purchased_stories'));
    }

    /**
     * Display the content of a premium story after the WooCommerce product details.
     */
    public function display_premium_story_content()
    {
        // Logic to get the story related to the product and display its content
        $product_id = get_the_ID();
        $related_story_id = get_post_meta($product_id, '_related_story_id', true);

        if ($related_story_id) {
            $story_content = get_post_field('post_content', $related_story_id);
            echo '<div id="premium-story-content">' . esc_html($story_content) . '</div>';
        }
    }

    /**
     * Add custom variation tabs for story-related options in WooCommerce product.
     *
     * @param array $tabs Existing product data tabs.
     * @return array Modified product data tabs.
     */
    public function add_story_variation_tabs($tabs)
    {
        $tabs['story_options'] = array(
            'label'    => __('Story Options', 'intimate-tales'),
            'target'   => 'story_options_product_data', // The ID of the <div> we want this tab to show
            'class'    => array('show_if_simple', 'show_if_variable'),
            'priority' => 21,
        );
        return $tabs;
    }

    /**
     * Display list of stories purchased by the user in their WooCommerce account dashboard.
     */
    public function display_user_purchased_stories()
    {
        $user_id = get_current_user_id();
        $purchased_stories = get_user_meta($user_id, '_purchased_stories', true);

        if (!empty($purchased_stories)) {
            echo '<div id="user-purchased-stories">';
            foreach ($purchased_stories as $story_id) {
                $story_title = get_the_title($story_id);
                echo '<div class="single-purchased-story">' . esc_html($story_title) . '</div>';
            }
            echo '</div>';
        }
    }
}

// Initialize the class instance.
IT_WooCommerce_Integration::instance();
