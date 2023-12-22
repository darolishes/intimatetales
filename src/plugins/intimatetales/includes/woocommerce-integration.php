<?php
/**
 * WooCommerce integration for IntimateTales WordPress plugin.
 */

// Ensure WordPress environment
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

// Check if WooCommerce is active
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

    /**
     * Add custom product data fields in WooCommerce.
     */
    function intimatetales_add_custom_product_fields() {
        global $woocommerce, $post;

        echo '<div class="options_group">';

        // Custom fields will be added here

        echo '</div>';
    }
    add_action( 'woocommerce_product_options_general_product_data', 'intimatetales_add_custom_product_fields' );

    /**
     * Save custom product fields data.
     *
     * @param int $post_id Post ID.
     */
    function intimatetales_save_custom_product_fields( $post_id ) {
        // Custom fields saving logic will be here
    }
    add_action( 'woocommerce_process_product_meta', 'intimatetales_save_custom_product_fields' );

    /**
     * Add custom product data tab.
     */
    function intimatetales_custom_product_tabs( $tabs ) {
        $tabs['intimatetales_tab'] = array(
            'label'    => __( 'IntimateTales', 'intimatetales' ),
            'target'   => 'intimatetales_product_data',
            'priority' => 50,
        );
        return $tabs;
    }
    add_filter( 'woocommerce_product_data_tabs', 'intimatetales_custom_product_tabs' );

    /**
     * Add content to the custom product data tab.
     */
    function intimatetales_custom_product_tab_content() {
        global $post;

        // Custom tab content will be here

    }
    add_action( 'woocommerce_product_data_panels', 'intimatetales_custom_product_tab_content' );

    /**
     * Custom order status for IntimateTales stories.
     */
    function intimatetales_register_custom_order_status() {
        register_post_status( 'wc-intimatetales', array(
            'label'                     => __( 'IntimateTales', 'intimatetales' ),
            'public'                    => true,
            'exclude_from_search'       => false,
            'show_in_admin_all_list'    => true,
            'show_in_admin_status_list' => true,
            'label_count'               => _n_noop( 'IntimateTales <span class="count">(%s)</span>', 'IntimateTales <span class="count">(%s)</span>', 'intimatetales' )
        ) );
    }
    add_action( 'init', 'intimatetales_register_custom_order_status' );

    /**
     * Add custom order status to WooCommerce order list.
     *
     * @param array $order_statuses Existing order statuses.
     * @return array Updated order statuses.
     */
    function intimatetales_add_custom_order_status( $order_statuses ) {
        $order_statuses['wc-intimatetales'] = _x( 'IntimateTales', 'Order status', 'intimatetales' );
        return $order_statuses;
    }
    add_filter( 'wc_order_statuses', 'intimatetales_add_custom_order_status' );

    // Additional WooCommerce integration code will be added here
}
