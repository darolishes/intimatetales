<?php
class IntimateTales_Notifications {

    private $user_id;

    public function __construct($user_id) {
        $this->user_id = $user_id;
    }

    /**
     * Send a generic interface notification to a user.
     * Allows adding buttons for actions.
     */
    public function send_interface_notification($message_key, $placeholders = array(), $buttons = array()) {
        $message = __($message_key, 'intimate-tales');

        // Replace placeholders in message
        foreach ($placeholders as $key => $value) {
            $message = str_replace("{{{$key}}}", $value, $message);
        }

        // Create buttons HTML
        $buttons_html = '';
        foreach ($buttons as $button) {
            $buttons_html .= '<a href="' . esc_url($button['url']) . '" class="notification-button">' . esc_html($button['label']) . '</a>';
        }

        // Get the notification template
        $template = $this->get_notification_template('interface', array(
            'message' => $message,
            'buttons' => $buttons_html,
        ));

        // Save the message as a notification in user meta
        add_user_meta($this->user_id, 'intimate_interface_notification', $template);
    }

    /**
     * Retrieve and clear all interface notifications for a user.
     */
    public function get_and_clear_interface_notifications() {
        $notifications = get_user_meta($this->user_id, 'intimate_interface_notification', false);

        // Clear the notifications after retrieval
        delete_user_meta($this->user_id, 'intimate_interface_notification');

        return $notifications;
    }

    // ... (other methods)

    /**
     * Get a notification template.
     */
    private function get_notification_template($type, $data) {
        // Define template paths
        $template_dir = INTIMATE_TALES_PLUGIN_PATH . 'templates/';
        $template_file = 'notification-' . $type . '.php';

        // Check if there's a custom template in the theme
        $custom_template = locate_template($template_file);
        if ($custom_template) {
            return $this->render_template($custom_template, $data);
        }

        // Fallback to the default plugin template
        return $this->render_template($template_dir . $template_file, $data);
    }

    /**
     * Render a template with data.
     */
    private function render_template($template_file, $data) {
        ob_start();
        include $template_file;
        return ob_get_clean();
    }
}
