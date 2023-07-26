<?php
namespace IntimateTales\Classes;

use Exception;
use WP_User;
use IntimateTales\Couple;

// Exit if accessed directly.
defined('ABSPATH') || exit;

/**
 * Class User
 * Represents a user of the Intimate Tales plugin with additional information.
 */
class User
{
    private static $instance = null;

    // Constants for intimacy levels
    const INTIMACY_LOW = 1;
    const INTIMACY_MEDIUM = 2;
    const INTIMACY_HIGH = 3;
    const INVITATION_FROM = 'invitation_from';

    // ACF field keys for storing data
    const INTIMACY_LEVEL = 'intimacy_level';
    const DESIRED_SCENARIOS = 'desired_scenarios';
    const ROLE_PLAYING_THEMES = 'role_playing_themes';

    private $intimacy_level;
    private $desired_scenarios;
    private $role_playing_themes;
    private $couple_id;

    private $wp_user; // An instance of WP_User


    /**
     * User constructor.
     * Private constructor to prevent direct instantiation.
     */
    private function __construct()
    {
    }

    // Public method to get a single instance of the class
    public static function get_instance()
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
    public function get_user_id(): int
    {
        return $this->wp_user->ID;
    }

    public function get_wp_user(): WP_User
    {
        return $this->wp_user;
    }

    /**
     * Get the User instance by WP_User ID.
     *
     * @param int $user_id The ID of the WP_User.
     * @return User|null The User instance, or null if the user does not exist.
     */
    public static function get_user_by_id(int $user_id): ?User
    {
        $wp_user = get_user_by('ID', $user_id);

        if (!$wp_user) {
            return null;
        }

        $instance = new self();
        $instance->wp_user = $wp_user;
        $instance->load_from_acf();

        return $instance;
    }

    /**
     * Load the user's additional information from ACF fields.
     */
    private function load_from_acf(): void
    {
        $user_id = $this->wp_user->ID;
        $this->intimacy_level = absint(get_field(self::INTIMACY_LEVEL, 'user_' . $user_id));
        $this->desired_scenarios = sanitize_text_field(get_field(self::DESIRED_SCENARIOS, 'user_' . $user_id));
        $this->role_playing_themes = sanitize_text_field(get_field(self::ROLE_PLAYING_THEMES, 'user_' . $user_id));
        $this->couple_id = Couple::get_by_user_id($user_id)->get_couple_id();
    }

    /**
     * Save the user's additional information to ACF fields.
     */
    public function save_additional_information(): void
    {
        $user_id = $this->wp_user->ID;
        update_field(self::INTIMACY_LEVEL, $this->intimacy_level, 'user_' . $user_id);
        update_field(self::DESIRED_SCENARIOS, $this->desired_scenarios, 'user_' . $user_id);
        update_field(self::ROLE_PLAYING_THEMES, $this->role_playing_themes, 'user_' . $user_id);
        update_field(Couple::COUPLE_ID, $this->couple_id, 'user_' . $user_id);
    }

    // Check if the user is part of a couple.
    public function is_couple()
    {
        // Check if the user has a couple ID associated.
        return !empty(get_field(Couple::COUPLE_ID, 'user_' . $this->wp_user->ID));
    }

    // Get the pending invitations for the user.
    public function get_invitations()
    {
        // Retrieve the invitations from user meta.
        return get_field(self::INVITATION_FROM, 'user_' . $this->wp_user->ID);
    }

    public function set_intimacy_level(int $intimacy_level): User
    {
        if (!in_array($intimacy_level, [self::INTIMACY_LOW, self::INTIMACY_MEDIUM, self::INTIMACY_HIGH])) {
            throw new Exception('Invalid intimacy level');
        }
        $this->intimacy_level = $intimacy_level;
        return $this;
    }

    public function send_invitation(User $partner)
    {
        if ($this->is_couple() || $partner->is_couple()) {
            throw new Exception('One of the users is already part of a couple');
        }
        update_field(self::INVITATION_FROM, $this->wp_user->ID, 'user_' . $partner->get_user_id());
    }

    public function accept_invitation(User $partner)
    {
        if ($this->is_couple() || $partner->is_couple()) {
            throw new Exception('One of the users is already part of a couple');
        }
        $couple = Couple::create($this->wp_user->ID, $partner->get_user_id());
        delete_user_meta($this->wp_user->ID, self::INVITATION_FROM);
    }

    public function decline_invitation(User $partner)
    {
        if ($this->is_couple()) {
            throw new Exception('User is part of a couple');
        }
        // Remove the invitation from the user meta of the current user using ACF delete_field function.
        delete_user_meta($this->wp_user->ID, self::INVITATION_FROM, $partner->get_user_id());
    }
}