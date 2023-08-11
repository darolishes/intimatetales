<?php

namespace IntimateTales;

class Interaction_Manager {

    // Fügt eine Nachricht zum Chat-Verlauf zwischen zwei Benutzern hinzu.
    public function add_chat_message($sender_id, $receiver_id, $message) {
        // Hier würden Sie die Nachricht in der Datenbank speichern.
        // Dies ist ein einfaches Beispiel:
        $chat_history = $this->get_chat_history($sender_id, $receiver_id);
        $chat_history[] = [
            'sender_id' => $sender_id,
            'message' => $message,
            'timestamp' => current_time('mysql')
        ];
        update_user_meta($sender_id, 'chat_with_' . $receiver_id, $chat_history);
    }

    // Holt den Chat-Verlauf zwischen zwei Benutzern.
    public function get_chat_history($user1_id, $user2_id) {
        return get_user_meta($user1_id, 'chat_with_' . $user2_id, true) ?? [];
    }

    // Sendet eine Benachrichtigung an einen Benutzer.
    public function send_notification($user_id, $message) {
        // Hier würden Sie eine Benachrichtigung an einen Benutzer senden, z.B. über eine Websocket-Verbindung oder durch Hinzufügen einer Benachrichtigung zur Datenbank.
        // Platzhalter:
        $notifications = $this->get_notifications($user_id);
        $notifications[] = [
            'message' => $message,
            'timestamp' => current_time('mysql')
        ];
        update_user_meta($user_id, 'notifications', $notifications);
    }

    // Holt alle Benachrichtigungen für einen Benutzer.
    public function get_notifications($user_id) {
        return get_user_meta($user_id, 'notifications', true) ?? [];
    }

    // Löscht eine Benachrichtigung für einen Benutzer.
    public function delete_notification($user_id, $notification_id) {
        $notifications = $this->get_notifications($user_id);
        unset($notifications[$notification_id]);
        update_user_meta($user_id, 'notifications', $notifications);
    }
}
