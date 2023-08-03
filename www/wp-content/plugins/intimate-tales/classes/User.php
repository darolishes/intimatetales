<?php
namespace IntimateTales;

use WP_User;

// Exit if accessed directly.
defined('ABSPATH') || exit;

/**
 * Class User
 * Represents a user of the Intimate Tales plugin with additional information.
 */
class User
{
    private static ?self $instance = null;

    // Constants for intimacy levels
    public const INTIMACY_LOW = 1;
    public const INTIMACY_MEDIUM = 2;
    public const INTIMACY_HIGH = 3;

    // ACF field keys for storing data
    private const INTIMACY_LEVEL = 'intimacy_level';
    private const DESIRED_SCENARIOS = 'desired_scenarios';
    private const ROLE_PLAYING_THEMES = 'role_playing_themes';

    private int $intimacy_level = self::INTIMACY_LOW;
    private string $desired_scenarios = '';
    private string $role_playing_themes = '';
    private int $couple_id = 0;

    private WP_User $wp_user; // An instance of WP_User

    /**
     * User constructor.
     * Private constructor to prevent direct instantiation.
     */
    private function __construct()
    {
    }

    // Public method to get a single instance of the class
    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Get the ID of the associated WP_User.
     *
     * @return int The ID of the WP_User.
     */
    public function getUserId(): int
    {
        return $this->wp_user->ID;
    }

    public function getWpUser(): WP_User
    {
        return $this->wp_user;
    }

    /**
     * Get the User instance by WP_User ID.
     *
     * @param int $user_id The ID of the WP_User.
     * @return User|null The User instance, or null if the user does not exist.
     */
    public static function getUserById(int $user_id): ?self
    {
        $wp_user = get_user_by('ID', $user_id);

        if (!$wp_user) {
            return null;
        }

        $instance = new self();
        $instance->wp_user = $wp_user;
        $instance->loadFromAcf();

        return $instance;
    }

    /**
     * Load the user's additional information from ACF fields.
     */
    private function loadFromAcf(): void
    {
        $user_id = $this->wp_user->ID;
        $this->intimacy_level = absint(get_field(self::INTIMACY_LEVEL, 'user_' . $user_id));
        $this->desired_scenarios = sanitize_text_field(get_field(self::DESIRED_SCENARIOS, 'user_' . $user_id));
        $this->role_playing_themes = sanitize_text_field(get_field(self::ROLE_PLAYING_THEMES, 'user_' . $user_id));

        // Check if the user is part of a couple before getting the couple id
        $this->couple_id = Couple::getCoupleIdByUserId($user_id);
    }

    /**
     * Save the user's additional information to ACF fields.
     */
    public function saveAdditionalInformation(): void
    {
        $user_id = $this->wp_user->ID;
        update_field(self::INTIMACY_LEVEL, $this->intimacy_level, 'user_' . $user_id);
        update_field(self::DESIRED_SCENARIOS, $this->desired_scenarios, 'user_' . $user_id);
        update_field(self::ROLE_PLAYING_THEMES, $this->role_playing_themes, 'user_' . $user_id);
        update_field(Couple::COUPLE_ID, $this->couple_id, 'user_' . $user_id);
    }

    // Check if the user is part of a couple.
    public function isCouple(): bool
    {
        // Check if the user has a couple ID associated.
        return !empty($this->couple_id);
    }

    // Get the pending invitations for the user.
    public function sendInvitation(User $partner): void
    {
        if ($this->isCouple() || $partner->isCouple()) {
            throw new \Exception('One of the users is already part of a couple');
        }

        // Check if the partner already has a pending invitation
        $pendingInvitations = $partner->getInvitations();
        if (in_array($this->wp_user->ID, $pendingInvitations)) {
            throw new \Exception('The user has already sent an invitation to this partner');
        }

        Couple::sendInvitation($this->wp_user->ID, $partner->getUserId());
    }

    public function acceptInvitation(User $partner): void
    {
        if ($this->isCouple() || $partner->isCouple()) {
            throw new \Exception('One of the users is already part of a couple');
        }

        Couple::acceptInvitation($this->wp_user->ID, $partner->getUserId());
    }

    public function declineInvitation(User $partner): void
    {
        if ($this->isCouple()) {
            throw new \Exception('User is part of a couple');
        }

        Couple::declineInvitation($this->wp_user->ID, $partner->getUserId());
    }

    /**
     * Get the invitations received by the user.
     *
     * @return array The array of user IDs who sent invitations to this user.
     */
    public function getInvitations(): array
    {
        return Couple::getInvitationsToUser($this->wp_user->ID);
    }
}