<?php
/**
 * Settings page for IntimateTales WordPress plugin.
 */

// Ensure WordPress environment
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Add settings page to the WordPress admin menu.
 */
function intimatetales_add_admin_menu() {
    add_menu_page(
        'IntimateTales Settings', // Page title
        'IntimateTales',          // Menu title
        'manage_options',         // Capability
        'intimatetales_settings', // Menu slug
        'intimatetales_settings_page', // Callback function
        'dashicons-heart',        // Icon
        20                        // Position
    );
}
add_action( 'admin_menu', 'intimatetales_add_admin_menu' );

/**
 * Settings page content.
 */
function intimatetales_settings_page() {
    ?>
    <div class="wrap">
        <h1>IntimateTales Settings</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields( 'intimatetales_settings' );
            do_settings_sections( 'intimatetales_settings' );
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

/**
 * Initialize settings.
 */
function intimatetales_settings_init() {
    register_setting( 'intimatetales_settings', 'intimatetales_settings' );

    add_settings_section(
        'intimatetales_settings_section', 
        __( 'General Settings', 'intimatetales' ), 
        'intimatetales_settings_section_callback', 
        'intimatetales_settings'
    );

    add_settings_field( 
        'intimatetales_custom_setting', 
        __( 'Custom Setting', 'intimatetales' ), 
        'intimatetales_custom_setting_render', 
        'intimatetales_settings', 
        'intimatetales_settings_section' 
    );
}
add_action( 'admin_init', 'intimatetales_settings_init' );

/**
 * Settings section callback function.
 */
function intimatetales_settings_section_callback() {
    echo __( 'Customize IntimateTales plugin settings.', 'intimatetales' );
}

/**
 * Render settings field.
 */
function intimatetales_custom_setting_render() {
    $options = get_option( 'intimatetales_settings' );
    ?>
    <input type='text' name='intimatetales_settings[intimatetales_custom_setting]' value='<?php echo $options['intimatetales_custom_setting']; ?>'>
    <?php
}
