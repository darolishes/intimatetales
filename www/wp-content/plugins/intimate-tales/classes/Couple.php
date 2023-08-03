<?php

namespace IntimateTales;

// Exit if accessed directly.
defined('ABSPATH') || exit;

/**
 * Class Couple
 * Represents a couple of the Intimate Tales plugin.
 */
class Couple {
    // ACF field keys for storing couple ID
    const COUPLE_ID = 'couple_id';

    private $couple_id; // The ID of the couple.
    private $user1_id; // The ID of the first user in the couple.
    private $user2_id; // The ID of the second user in the couple.
    private $creation_date; // The creation date of the couple.

    // Constructor
    public function __construct($couple_id = null, $user1_id = null, $user2_id = null, $creation_date = null) {
        if (!is_null($user1_id) && !is_numeric($user1_id)) {
            throw new \InvalidArgumentException("User1 ID must be a number.");
        }
        if (!is_null($user2_id) && !is_numeric($user2_id)) {
            throw new \InvalidArgumentException("User2 ID must be a number.");
        }
        $this->couple_id = $couple_id;
        $this->user1_id = $user1_id;
        $this->user2_id = $user2_id;
        $this->creation_date = $creation_date;
    }

    // Create a new couple and save it to the database.
    public static function create(int $user1_id, int $user2_id): Couple {
        // Check that the user IDs are valid
        if (!get_userdata($user1_id) || !get_userdata($user2_id)) {
            throw new \Exception("Invalid user ID(s).");
        }
        // Generate a new UUID for the couple.
        $couple_id = wp_generate_uuid4();

        // Create the new Couple object.
        $couple = new self();
        $couple->couple_id = $couple_id;
        $couple->user1_id = $user1_id;
        $couple->user2_id = $user2_id;

        // Add the current date as the creation date of the couple
        $couple->creation_date = date('Y-m-d H:i:s');

        // Save the couple to the database.
        $couple->save();

        return $couple;
    }

    public function set_couple_id($couple_id) {
        $this->couple_id = $couple_id;
    }

    public function set_user1_id($user1_id) {
        $this->user1_id = $user1_id;
    }

    public function set_user2_id($user2_id) {
        $this->user2_id = $user2_id;
    }

    public function set_creation_date($creation_date) {
        $this->creation_date = $creation_date;
    }

    public function get_creation_date(): ?string {
        return $this->creation_date;
    }

    /**
     * Get the Couple object associated with a user.
     *
     * @param int $user_id The ID of the user.
     * @return Couple|null The Couple object, or null if the user is not in a couple.
     */
    public static function get_by_user_id(int $user_id): ?Couple {
        // Get the couple ID from the user's ACF field.
        $couple_id = get_field(self::COUPLE_ID, 'user_' . $user_id);

        if (!$couple_id) {
            return null;
        }

        // Create a new Couple object.
        $couple = new self();
        $couple->couple_id = $couple_id;
        $couple->user1_id = $user_id;

        // Get the creation date of the couple
        $couple->creation_date = get_user_meta($user_id, 'couple_creation_date', true);

        // Get the other user in the couple.
        $couple->user2_id = get_users(array(
            'meta_key' => self::COUPLE_ID,
            'meta_value' => $couple_id,
            'exclude' => array($user_id)
        ))[0]->ID;

        return $couple;
    }

    /**
     * Gets the couple ID.
     *
     * @return string|null The couple ID, or null if it doesn't exist.
     */
    public function get_couple_id(): ?string {
        return $this->couple_id;
    }

    // Getter methods
    public function get_user1_id(): ?int {
        return $this->user1_id;
    }

    public function get_user2_id(): ?int {
        return $this->user2_id;
    }

    // Save the couple to the database.
    public function save(): void {
        global $wpdb;

        // Data sanitization
        $couple_id = sanitize_text_field($this->couple_id);
        $user1_id = intval($this->user1_id);
        $user2_id = intval($this->user2_id);

        try {
            $wpdb->query('START TRANSACTION');

            // Save the couple ID to the users' ACF fields.
            if (!update_field(self::COUPLE_ID, $couple_id, 'user_' . $user1_id) ||
                !update_field(self::COUPLE_ID, $couple_id, 'user_' . $user2_id)) {
                throw new \Exception('Failed to update couple ID');
            }

            // Save the creation date of the couple to the users' meta fields
            if (!update_user_meta($this->user1_id, 'couple_creation_date', $this->creation_date) ||
                !update_user_meta($this->user2_id, 'couple_creation_date', $this->creation_date)) {
                throw new \Exception('Failed to update creation date');
            }

            $wpdb->query('COMMIT');
        } catch (\Exception $e) {
            $wpdb->query('ROLLBACK');
            error_log('Error in Couple::save: ' . $e->getMessage());
        }
    }

    // Remove the association between the users in the couple.
    public function disconnect(): void {
        // Remove the couple ID from the users' ACF fields.
        delete_field(self::COUPLE_ID, 'user_' . $this->user1_id);
        delete_field(self::COUPLE_ID, 'user_' . $this->user2_id);

        // Remove the creation date from the users' meta fields
        delete_user_meta($this->user1_id, 'couple_creation_date');
        delete_user_meta($this->user2_id, 'couple_creation_date');
    }
}
