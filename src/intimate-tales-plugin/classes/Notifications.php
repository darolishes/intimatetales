<?php

namespace IntimateTales\Classes;

use IntimateTales\Classes\User;
use IntimateTales\Classes\Views;

/**
 * Intimate Tales Notifications Class
 *
 * This class handles user notifications, both through email and in-app notices.
 *
 * @class    Notifications
 * @version  1.0.0
 * @package  IntimateTales/Classes
 */

class Notifications
{
    private $notifications = [];
    private $views;
    private $user_data;

    public function __construct(User $user)
    {
        $this->user_data = $user->get_user_data();

        $this->views = new Views();
    }

    private function is_email_notification_enabled()
    {
        return $this->user_data['settings']['email_notifications'] ?? false;
    }

    private function is_in_app_notification_enabled()
    {
        return $this->user_data['settings']['in_app_notifications'] ?? false;
    }

    protected function send_email($subject, $message)
    {
        if ($this->is_email_notification_enabled()) {
            $email_content = $this->views->part('email', ['message' => $message], 'email');

            wp_mail($this->user_data['email'], $subject, $email_content, 'Content-Type: text/html; charset=UTF-8');
        }
    }

    protected function in_app_notice($key, $data = [])
    {
        if ($this->is_in_app_notification_enabled()) {
            $message_template = $this->notifications[$key]['in_app_message'];
            $message = sprintf($message_template, array_values($data));

            echo $this->views->part('notice', ['message' => $message], 'notifications');
        }
    }

    public function add($key, $details)
    {
        $this->notifications[$key] = $details;
    }

    public function get_notification($notification)
    {
        return $this->notifications[$notification] ?? null;
    }

    public function notify($type, $notification_type, $data = [])
    {
        if (!isset($this->notifications[$notification_type])) {
            return;
        }

        switch ($type) {
            case 'email':
                $subject = $this->notifications[$notification_type]['subject'];
                $this->send_email($subject, $data['message']);
                break;
            case 'in_app':
                $this->in_app_notice($notification_type, $data);
                break;
        }
    }

    public function get_current_user_notifications()
    {
        global $wpdb;

        $table_name = $wpdb->prefix . 'notifications';
        $user_id = $this->user_data['id'];

        $results = $wpdb->get_results($wpdb->prepare("SELECT * FROM {$table_name} WHERE user_id = %d", $user_id));

        return $results;
    }
}
