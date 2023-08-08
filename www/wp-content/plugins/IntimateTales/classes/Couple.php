<?php

namespace IntimateTales;

defined('ABSPATH') || exit;

use IntimateTales\User;
use IntimateTales\Story;

class InvalidUserIdException extends \Exception
{
}
class UserAlreadyInCoupleException extends \Exception
{
}
class CoupleNotFoundException extends \Exception
{
}

class Couple
{
    const COUPLE_INVITATIONS = 'couple_invitations';
    const COUPLE_CREATION_DATE = 'couple_creation_date';
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
            throw new InvalidUserIdException("Invalid user ID(s).");
        }

        $user1 = User::getUserById($user1_id);
        $user2 = User::getUserById($user2_id);

        if ($user1->isPartOfCouple() || $user2->isPartOfCouple()) {
            throw new UserAlreadyInCoupleException("One or both users are already part of a couple.");
        }

        $couple_id = wp_generate_uuid4();
        $couple = new self($couple_id, $user1_id, $user2_id, date('Y-m-d H:i:s'));
        $couple->save();

        return $couple;
    }

    public static function validateUserId(int $user_id): bool
    {
        $user = get_userdata($user_id);
        if ($user === false) {
            throw new InvalidUserIdException("Invalid user ID.");
        }
        return true;
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
                if (
                    !update_field(self::COUPLE_ID, $couple_id, 'user_' . $user_id) ||
                    !update_user_meta($user_id, 'couple_creation_date', $this->creation_date)
                ) {
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
     * Check if a user has already received an invitation from another user.
     *
     * @param int $user_id The ID of the user receiving the invitation.
     * @param int $partner_id The ID of the user sending the invitation.
     * @return bool True if the user has already received an invitation, false otherwise.
     */
    public static function hasReceivedInvitation(int $user_id, int $partner_id): bool
    {
        $invitations = self::getInvitationsToUser($user_id);
        return in_array($partner_id, $invitations);
    }

    /**
     * Send an invitation to create a couple.
     *
     * @param int $user_id The ID of the user sending the invitation.
     * @param int $partner_id The ID of the user receiving the invitation.
     */
    public static function sendInvitation(int $user_id, int $partner_id): void
    {
        self::validateUserId($user_id);
        self::validateUserId($partner_id);

        if (self::hasReceivedInvitation($partner_id, $user_id)) {
            throw new \InvalidArgumentException("User has already received an invitation from this user.");
        }

        // Add the user's ID to the partner's invitation list
        $partner_invitations = self::getInvitationsToUser($partner_id);
        $partner_invitations[] = $user_id;
        $partner_invitations = array_unique($partner_invitations);

        update_user_meta($partner_id, self::COUPLE_INVITATIONS, $partner_invitations);
    }

    public static function getCoupleByUserId(int $user_id): ?self
    {
        self::validateUserId($user_id);

        $couple_id = get_field(self::COUPLE_ID, 'user_' . $user_id);

        if (!$couple_id) {
            throw new CoupleNotFoundException("Couple not found for this user.");
        }

        $couple = new self();
        $couple->couple_id = $couple_id;
        $couple->user1_id = $user_id;
        $couple->creation_date = get_user_meta($user_id, self::COUPLE_CREATION_DATE, true);

        $couple->user2_id = self::getOtherUserId($couple_id, $user_id);

        return $couple;
    }

    /**
     * Decline an invitation to create a couple.
     *
     * @param int $user_id The ID of the user declining the invitation.
     * @param int $partner_id The ID of the user who sent the invitation.
     */
    public static function declineInvitation(int $user_id, int $partner_id): void
    {
        self::validateUserId($user_id);
        self::validateUserId($partner_id);

        // Remove the user's ID from the partner's invitation list
        $partner_invitations = self::getInvitationsToUser($user_id);
        if (($key = array_search($partner_id, $partner_invitations)) !== false) {
            unset($partner_invitations[$key]);
        }

        update_user_meta($user_id, self::COUPLE_INVITATIONS, $partner_invitations);
    }

    // New methods

    public function notify(string $notificationType): void
    {
        // Implement your own logic to manage notifications
        // $notificationType could be 'new_story', 'new_comment', 'new_message', etc.
    }

    public function sendMessage(User $user, string $message): void
    {
        // Implement your own logic to send a message
    }

    public function shareStory(Story $story): void
    {
        // Implement your own logic to share a story
    }
}
