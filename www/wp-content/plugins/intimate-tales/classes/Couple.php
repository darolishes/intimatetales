<?php
namespace IntimateTales;

// Exit if accessed directly.
defined('ABSPATH') || exit;

/**
 * Class Couple
 * Represents a couple in the Intimate Tales plugin.
 */
class Couple
{
    // ACF field keys for storing couple ID
    public const COUPLE_ID = 'couple_id';

    private ?string $couple_id = null; // The ID of the couple.
    private int $user1_id = 0; // The ID of the first user in the couple.
    private int $user2_id = 0; // The ID of the second user in the couple.
    private ?string $creation_date = null; // The creation date of the couple.

    // Constructor
    public function __construct(?string $couple_id = null, int $user1_id = 0, int $user2_id = 0, ?string $creation_date = null)
    {
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

    public static function create(int $user1_id, int $user2_id): self
    {
        if (!self::validateUserId($user1_id) || !self::validateUserId($user2_id)) {
            throw new \Exception("Invalid user ID(s).");
        }

        $couple_id = wp_generate_uuid4();
        $couple = new self($couple_id, $user1_id, $user2_id, date('Y-m-d H:i:s'));
        $couple->save();

        return $couple;
    }

    public static function getCoupleIdByUserId(int $user_id): ?string
    {
        $couple_id = get_field(self::COUPLE_ID, 'user_' . $user_id);

        if (!$couple_id) {
            return null;
        }

        $couple = new self();
        $couple->couple_id = $couple_id;
        $couple->user1_id = $user_id;
        $couple->creation_date = get_user_meta($user_id, 'couple_creation_date', true);

        $couple->user2_id = self::getOtherUserId($couple_id, $user_id);

        return $couple;
    }

    public function getCoupleId(): ?string
    {
        return $this->couple_id;
    }

    public function getUser1Id(): int
    {
        return $this->user1_id;
    }

    public function getUser2Id(): int
    {
        return $this->user2_id;
    }

    public function getCreationDate(): ?string
    {
        return $this->creation_date;
    }

    public function save(): void
    {
        global $wpdb;
        $couple_id = sanitize_text_field($this->couple_id);

        try {
            $wpdb->query('START TRANSACTION');

            foreach ([$this->user1_id, $this->user2_id] as $user_id) {
                if (!update_field(self::COUPLE_ID, $couple_id, 'user_' . $user_id) ||
                    !update_user_meta($user_id, 'couple_creation_date', $this->creation_date)) {
                    throw new \Exception('Failed to update couple data');
                }
            }

            $wpdb->query('COMMIT');
        } catch (\Exception $e) {
            $wpdb->query('ROLLBACK');
            error_log('Error in Couple::save: ' . $e->getMessage());
        }
    }

    public function disconnect(): void
    {
        foreach ([$this->user1_id, $this->user2_id] as $user_id) {
            delete_field(self::COUPLE_ID, 'user_' . $user_id);
            delete_user_meta($user_id, 'couple_creation_date');
        }
    }

    private static function validateUserId(int $user_id): bool
    {
        return (bool) get_userdata($user_id);
    }

    private static function getOtherUserId(string $couple_id, int $user_id): int
    {
        $users = get_users([
            'meta_key' => self::COUPLE_ID,
            'meta_value' => $couple_id,
            'exclude' => [$user_id],
            'number' => 1
        ]);

        return $users[0]->ID ?? 0;
    }

    /**
     * Get the invitations received by the user.
     *
     * @param int $user_id The ID of the user to get invitations for.
     * @return array The array of user IDs who sent invitations to this user.
     */
    public static function getInvitationsToUser(int $user_id): array
    {
        $invitations = [];
        $user_ids = get_users([
            'meta_key' => self::COUPLE_ID,
            'meta_value' => 'user_' . $user_id,
            'fields' => 'ID'
        ]);

        if (!empty($user_ids)) {
            foreach ($user_ids as $id) {
                $invitations[] = intval(str_replace('user_', '', $id));
            }
        }

        return $invitations;
    }

    /**
     * Send an invitation to create a couple.
     *
     * @param int $user_id The ID of the user sending the invitation.
     * @param int $partner_id The ID of the user receiving the invitation.
     */
    public static function sendInvitation(int $user_id, int $partner_id): void
    {
        // Add the user's ID to the partner's invitation list
        $partner_invitations = self::getInvitationsToUser($partner_id);
        $partner_invitations[] = $user_id;
        $partner_invitations = array_unique($partner_invitations);

        update_user_meta($partner_id, 'couple_invitations', $partner_invitations);
    }

    /**
     * Accept an invitation to create a couple.
     *
     * @param int $user_id The ID of the user accepting the invitation.
     * @param int $partner_id The ID of the user who sent the invitation.
     */
    public static function acceptInvitation(int $user_id, int $partner_id): void
    {
        // Create a new couple
        $couple = self::create($user_id, $partner_id);

        // Remove the user's ID from the partner's invitation list
        $partner_invitations = self::getInvitationsToUser($user_id);
        if (($key = array_search($partner_id, $partner_invitations)) !== false) {
            unset($partner_invitations[$key]);
        }

        update_user_meta($user_id, 'couple_invitations', $partner_invitations);
    }

    /**
     * Decline an invitation to create a couple.
     *
     * @param int $user_id The ID of the user declining the invitation.
     * @param int $partner_id The ID of the user who sent the invitation.
     */
    public static function declineInvitation(int $user_id, int $partner_id): void
    {
        // Remove the user's ID from the partner's invitation list
        $partner_invitations = self::getInvitationsToUser($user_id);
        if (($key = array_search($partner_id, $partner_invitations)) !== false) {
            unset($partner_invitations[$key]);
        }

        update_user_meta($user_id, 'couple_invitations', $partner_invitations);
    }
}