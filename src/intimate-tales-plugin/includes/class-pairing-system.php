<?php

class IntimateTales_Pairing_System {

    private $user_id;
    private $mainClassInstance;

    public function __construct($user_id) {
        $this->user_id = $user_id;
        $this->mainClassInstance = new IntimateTales_Main_Class();
    }

    /**
     * Send a pairing request to another user.
     */
    public function send_pairing_request($target_user_id) {
        // Check if request already exists
        if ($this->does_request_exist($target_user_id)) {
            return false;
        }

        // Store the request in usermeta
        add_user_meta($this->user_id, 'intimate_pairing_request_sent', $target_user_id);
        add_user_meta($target_user_id, 'intimate_pairing_request_received', $this->user_id);

        // Send a notification to the target user
        $this->send_notification($target_user_id, "Pairing Request", "You have received a new pairing request from user ID {$this->user_id}.");

        return true;
    }

    /**
     * Send a notification email.
     */
    private function send_notification($to_user_id, $subject_key, $message_key, $placeholders = array()) {
        $user_info = get_userdata($to_user_id);
        $to_email = $user_info->user_email;

        // Check user preferences
        if (!$this->should_notify($to_user_id, $subject_key)) {
            return false;
        }

        // Localization
        $subject = __($subject_key, 'intimate-tales'); // Assuming 'intimate-tales' is your text domain
        $message = __($message_key, 'intimate-tales');

        // Replace placeholders in message
        foreach ($placeholders as $key => $value) {
            $message = str_replace("{{{$key}}}", $value, $message);
        }

        // Use WordPress's built-in mail function
        wp_mail($to_email, $subject, $this->get_email_template($message));

        return true;
    }

    /**
     * Check if the user has opted in for the given notification type.
     */
    private function should_notify($user_id, $notification_type) {
        $preferences = get_user_meta($user_id, 'intimate_notification_preferences', true);
        
        // If preferences not set, assume user wants all notifications (or set your default here)
        if (!$preferences) {
            return true;
        }

        return isset($preferences[$notification_type]) && $preferences[$notification_type] == 'yes';
    }

    /**
     * Get the email template with the given message.
     */
    private function get_email_template($message) {
        $template_path = $this->mainClassInstance->load_template('email-template');

        // Replace the message placeholder in the template
        $template_content = str_replace('{{message}}', $message, $template_path);

        return $template_content;
    }

    /**
     * Accept a pairing request.
     */
    public function accept_pairing_request($from_user_id) {
        // Check if request exists
        if (!$this->does_request_exist($from_user_id)) {
            return false;
        }

        // Convert request to an established connection
        add_user_meta($this->user_id, 'intimate_paired_with', $from_user_id);
        add_user_meta($from_user_id, 'intimate_paired_with', $this->user_id);

        // Remove the initial request
        delete_user_meta($this->user_id, 'intimate_pairing_request_received', $from_user_id);
        delete_user_meta($from_user_id, 'intimate_pairing_request_sent', $this->user_id);

        return true;
    }

    /**
     * Decline a pairing request.
     */
    public function decline_pairing_request($from_user_id) {
        // Remove the initial request
        delete_user_meta($this->user_id, 'intimate_pairing_request_received', $from_user_id);
        delete_user_meta($from_user_id, 'intimate_pairing_request_sent', $this->user_id);

        return true;
    }

    /**
     * Withdraw a sent pairing request.
     */
    public function withdraw_pairing_request($target_user_id) {
        // Remove the sent request
        delete_user_meta($this->user_id, 'intimate_pairing_request_sent', $target_user_id);
        delete_user_meta($target_user_id, 'intimate_pairing_request_received', $this->user_id);

        return true;
    }

    /**
     * Check if a pairing request already exists.
     */
    private function does_request_exist($target_user_id) {
        return in_array($target_user_id, get_user_meta($this->user_id, 'intimate_pairing_request_sent', false));
    }
}
