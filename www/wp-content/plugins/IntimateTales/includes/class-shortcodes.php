<?php
namespace IntimateTales;

// Exit if accessed directly.
defined('ABSPATH') || exit;

class Shortcodes {
    /**
     * Initialize the shortcodes.
     * 
     * @return void
     */
    public static function init() {
        add_shortcode('intimatetales_invitation_form', [self::class, 'invitation_form']);
        add_shortcode('intimatetales_invitations_view', [self::class, 'invitations_view']);
    }

    /**
     * Shortcode for displaying the invitation form.
     * 
     * @return string The HTML content to display.
     */
    public static function invitation_form() {
        ob_start();
        include plugin_dir_path(__FILE__) . '../templates/invitation-form.php';
        return ob_get_clean();
    }
    /**
     * Shortcode for displaying the invitations view.
     * 
     * @return string The HTML content to display.
     */
    public static function invitations_view() {
        $current_user = wp_get_current_user();

        if (0 == $current_user->ID) {
            // Not logged in.
            return 'Please log in to view your invitations.';
        }

        // Logged in.
        $user = User::get_instance()->get_user_by_id($current_user->ID);

        if (!$user) {
            // User instance not found.
            return 'User not found.';
        }

        $invitations = $user->getInvitations();

        ob_start();
        include plugin_dir_path(__FILE__) . '../templates/invitations-view.php';
        return ob_get_clean();
    }
}
