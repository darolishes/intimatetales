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

    public function __construct($couple_id = null, $user1_id = null, $user2_id = null) {
        $this->couple_id = $couple_id;
        $this->user1_id = $user1_id;
        $this->user2_id = $user2_id;
    }

    // Create a new couple and save it to the database.
    public static function create(int $user1_id, int $user2_id): Couple {
        // Generate a new UUID for the couple.
        $couple_id = wp_generate_uuid4();

        // Create the new Couple object.
        $couple = new self();
        $couple->couple_id = $couple_id;
        $couple->user1_id = $user1_id;
        $couple->user2_id = $user2_id;

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

    /**
     * Save the couple to the database.
     */
    public function save(): void {
        // Save the couple ID to the users' ACF fields.
        update_field(self::COUPLE_ID, $this->couple_id, 'user_' . $this->user1_id);
        update_field(self::COUPLE_ID, $this->couple_id, 'user_' . $this->user2_id);
    }

    /**
     * Remove the association between the users in the couple.
     */
    public function disconnect(): void {
        // Remove the couple ID from the users' ACF fields.
        delete_field(self::COUPLE_ID, 'user_' . $this->user1_id);
        delete_field(self::COUPLE_ID, 'user_' . $this->user2_id);
    }
}
