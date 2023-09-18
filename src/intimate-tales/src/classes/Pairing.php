<?php

namespace IntimateTales\Classes;

use IntimateTales\Classes\Notifications;
use IntimateTales\Classes\User;

/**
 * Intimate Tales Pairing System.
 *
 * Handles the pairing of users within the Intimate Tales application.
 *
 * @package IntimateTales
 * @subpackage Pairing
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Pairing
{
    const META_SENT_PAIRING     = 'it_sent_pairing_request';
    const META_RECEIVED_PAIRING = 'it_received_pairing_request';
    const META_PAIRED_WITH      = 'it_paired_with';

    private $user_id;
    private $notifications;

    public function __construct(User $user_id, Notifications $notifications)
    {
        $this->user_id = $user_id;
        $this->notifications = $notifications;

        $this->add_notifications();
    }

    private function add_notifications()
    {
        // Assuming that the Notifications class supports dynamic addition of notification types.
        $notifications = [
            'pairing_acceptance' => [
                'subject'        => __('Pairing Request Accepted', 'intimatetales'),
                'in_app_message' => __('%d has accepted your pairing request.', 'intimatetales'),
            ],
            'pairing_decline'    => [
                'subject'        => __('Pairing Request Declined', 'intimatetales'),
                'in_app_message' => __('%d has declined your pairing request.', 'intimatetales'),
            ],
            'pairing_request'    => [
                'subject'        => __('New Pairing Request', 'intimatetales'),
                'in_app_message' => __('You have received a new pairing request from %d.', 'intimatetales'),
            ],
            'pairing_withdraw'   => [
                'subject'        => __('Pairing Request Withdrawn', 'intimatetales'),
                'in_app_message' => __('%d has withdrawn their pairing request.', 'intimatetales'),
            ],
        ];

        foreach ($notifications as $key => $data) {
            $this->notifications->add($key, $data);
        }
    }

    /**
     * Send a pairing request to another user.
     *
     * @param int $target_user_id Target user ID to send request to.
     * @return bool True if successful, False otherwise.
     */
    public function send_pairing_request($target_user_id)
    {
        if ($this->are_users_paired($target_user_id)) {
            return false;  // Users are already paired
        }

        update_user_meta($this->user_id, self::META_SENT_PAIRING, $target_user_id);
        update_user_meta($target_user_id, self::META_RECEIVED_PAIRING, $this->user_id);

        $notification = $this->notifications->get_notification_type('pairing_request');
        $notification->notify($this->user_id, $target_user_id);

        return true;
    }

    /**
     * Check if a pairing request exists.
     *
     * @param int $target_user_id Target user ID to check request for.
     * @return bool True if request exists, False otherwise.
     */
    private function does_request_exist($target_user_id)
    {
        $sent_request = get_user_meta($this->user_id, 'sent_pairing_request', true);
        $received_request = get_user_meta($target_user_id, 'received_pairing_request', true);

        return ($sent_request == $target_user_id) && ($received_request == $this->user_id);
    }

    /**
     * Accept a pairing request.
     *
     * @param int $from_user_id User ID from which request was received.
     * @return bool True if successful, False otherwise.
     */
    public function accept_pairing_request($requesting_user_id)
    {
        if (!$this->does_request_exist($requesting_user_id)) {
            return false;
        }

        delete_user_meta($this->user_id, 'received_pairing_request', $requesting_user_id);
        delete_user_meta($requesting_user_id, 'sent_pairing_request', $this->user_id);

        update_user_meta($this->user_id, 'paired_with', $requesting_user_id);
        update_user_meta($requesting_user_id, 'paired_with', $this->user_id);

        $message = sprintf(__("User ID %d has accepted your pairing request.", 'intimatetales'), $this->user_id);
        $this->notifications->notify('email', 'pairing_acceptance', ['message' => $message]);

        return true;
    }

    /**
     * Decline a pairing request.
     *
     * @param int $from_user_id User ID from which request was received.
     * @return bool True if successful, False otherwise.
     */
    public function decline_pairing_request($requesting_user_id)
    {
        if (!$this->does_request_exist($requesting_user_id)) {
            return false;
        }

        delete_user_meta($this->user_id, 'received_pairing_request', $requesting_user_id);
        delete_user_meta($requesting_user_id, 'sent_pairing_request', $this->user_id);

        $message = sprintf(__("User ID %d has declined your pairing request.", 'intimatetales'), $this->user_id);
        $this->notifications->notify('email', 'pairing_decline', ['message' => $message]);

        return true;
    }

    /**
     * Withdraw a sent pairing request.
     *
     * @param int $target_user_id Target user ID to whom request was sent.
     * @return bool True if successful, False otherwise.
     */
    public function withdraw_pairing_request($target_user_id)
    {
        $sent_request = get_user_meta($this->user_id, 'sent_pairing_request', true);
        if ($sent_request != $target_user_id) {
            return false;
        }

        delete_user_meta($this->user_id, 'sent_pairing_request', $target_user_id);
        delete_user_meta($target_user_id, 'received_pairing_request', $this->user_id);

        $message = sprintf(__("User ID %d has withdrawn their pairing request.", 'intimatetales'), $this->user_id);
        $this->notifications->notify('email', 'pairing_withdraw', ['message' => $message]);

        return true;
    }

    /**
     * Check if the users are already paired.
     *
     * @param int $other_user_id User ID of the other user.
     * @return bool True if paired, False otherwise.
     */
    private function are_users_paired($other_user_id)
    {
        $paired_with = get_user_meta($this->user_id, 'paired_with', true);
        return ($paired_with == $other_user_id);
    }

    /**
     * Unpair two users.
     *
     * @param int $other_user_id User ID of the other user to unpair with.
     * @return bool True if successful, False otherwise.
     */
    public function unpair_users($other_user_id)
    {
        if (!$this->are_users_paired($other_user_id)) {
            return false;  // Users aren't paired
        }

        delete_user_meta($this->user_id, 'paired_with', $other_user_id);
        delete_user_meta($other_user_id, 'paired_with', $this->user_id);

        $message = sprintf(__("User ID %d and User ID %d are now unpaired.", 'intimatetales'), $this->user_id, $other_user_id);
        $this->notifications->notify('in_app', 'unpaired', ['message' => $message]);

        return true;
    }
}
