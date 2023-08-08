<?php

namespace IntimateTales;

use WP_User;
use IntimateTales\UserFactory;
use IntimateTales\Story;
use InvalidArgumentException;

defined('ABSPATH') || exit;

// Custom Exceptions
class InvalidUserIdException extends \Exception
{
}

class UserAlreadyInCoupleException extends \Exception
{
}

class User
{
    // Intimacy Levels
    const INTIMACY_LOW = 1;
    const INTIMACY_MEDIUM = 2;
    const INTIMACY_HIGH = 3;

    // User meta keys
    private const INTIMACY_LEVEL = 'intimacy_level';
    private const PREFERRED_GENRES = 'preferred_genres';
    private const PREFERRED_SCENES = 'preferred_scenes';
    private const PREFERRED_FORMATS = 'preferred_formats';

    // Properties
    private int $intimacy_level = self::INTIMACY_LOW;
    private array $preferred_genres = [];
    private array $preferred_scenes = [];
    private array $preferred_formats = [];
    private int $couple_id = 0;

    private WP_User $wp_user;

    /**
     * Represents a user in the system.
     */
    private function __construct()
    {
        // Private constructor to prevent direct instantiation
    }

    /**
     * Get a User instance by the WP_User ID.
     *
     * @param int $user_id The ID of the WP_User.
     * @return User|null The User instance, or null if the user does not exist.
     */
    public static function getUserById(int $user_id): ?self
    {
        // Get the WP_User instance from the provided ID
        $wp_user = get_user_by('ID', $user_id);

        // If no WP_User found, return null
        if (!$wp_user) {
            return null;
        }

        // Create a new User instance
        $instance = new self();

        // Set the WP_User property of the User instance
        $instance->wp_user = $wp_user;

        // Load additional data from Advanced Custom Fields (ACF)
        $instance->loadFromAcf();

        // Return the User instance
        return $instance;
    }

    /**
     * Get the user ID associated with this object.
     *
     * @return int The user ID.
     */
    public function getUserId(): int
    {
        // Get the ID of the WP_User associated with this User instance
        return $this->wp_user->ID;
    }

    /**
     * Get the WordPress user associated with this object.
     *
     * @return WP_User The WordPress user object.
     */
    public function getWpUser(): WP_User
    {
        // Get the WP_User associated with this User instance
        // If the WP_User is not already set, fetch it using the stored user ID
        if ($this->wp_user === null) {
            $this->wp_user = get_user_by('ID', $this->getUserId());
        }
        return $this->wp_user;
    }

    /**
     * Get the preferred genres of the user.
     *
     * @return array
     */
    public function getPreferredGenres(): array
    {
        // Get the preferred genres of the user
        // If the property does not exist, return an empty array as the default value
        return $this->wp_user->preferred_genres ?? [];
    }

    /**
     * Get the preferred scenes of the user.
     *
     * @return array
     */
    public function getPreferredScenes(): array
    {
        return $this->wp_user->preferred_scenes ?? [];
    }

    /**
     * Get the preferred formats of the user.
     *
     * @return array
     */
    public function getPreferredFormats(): array
    {
        return $this->wp_user->preferred_formats ?? [];
    }

    /**
     * Check if the current object represents a couple.
     *
     * @return bool
     */
    public function isCouple(): bool
    {
        return !empty($this->couple_id);
    }

    /**
     * Check if the user is part of a couple.
     *
     * @return bool
     */
    public function isPartOfCouple(): bool
    {
        return get_field('couple_id', 'user_' . $this->wp_user->ID) !== false;
    }



    /**
     * Set the preferred genres for the user.
     *
     * @param array $genres - An array of genre slugs.
     * @throws InvalidArgumentException - If any of the genres are invalid.
     * @return void
     */
    public function setPreferredGenres(array $genres): void
    {
        $validGenres = get_terms([
            'taxonomy' => TaxonomyRegistration::TAX_GENRE,
            'hide_empty' => false,
            'fields' => 'slugs'
        ]);
        foreach ($genres as $genre) {
            if (!in_array($genre, $validGenres)) {
                throw new InvalidArgumentException('Invalid genre: ' . $genre);
            }
        }
        $this->preferred_genres = $genres;
        update_field(self::PREFERRED_GENRES, $genres, 'user_' . $this->getUserId());
    }

    /**
     * Set the preferred scenes for the user.
     *
     * @param array $scenes - An array of scene slugs.
     * @throws InvalidArgumentException - If any of the scenes provided are invalid.
     * @return void
     */
    public function setPreferredScenes(array $scenes): void
    {
        $validScenes = get_terms([
            'taxonomy' => TaxonomyRegistration::TAX_SCENE,
            'hide_empty' => false,
            'fields' => 'slugs'
        ]);

        foreach ($scenes as $scene) {
            if (!in_array($scene, $validScenes, true)) {
                throw new InvalidArgumentException('Invalid scene: ' . $scene);
            }
        }

        $this->preferred_scenes = $scenes;
        update_field(self::PREFERRED_SCENES, $scenes, 'user_' . $this->getUserId());
    }

    /**
     * Set the preferred formats for the user.
     *
     * @param array $formats An array of valid formats.
     * @throws InvalidArgumentException If an invalid format is provided.
     * @return void
     */
    public function setPreferredFormats(array $formats): void
    {
        $validFormats = get_terms([
            'taxonomy' => TaxonomyRegistration::TAX_FORMAT,
            'hide_empty' => false,
            'fields' => 'slugs'
        ]);

        foreach ($formats as $format) {
            if (!in_array($format, $validFormats, true)) {
                throw new InvalidArgumentException('Invalid format: ' . $format);
            }
        }

        $this->preferred_formats = $formats;
        update_field(self::PREFERRED_FORMATS, $formats, 'user_' . $this->getUserId());
    }

    /**
     * Load user data from Advanced Custom Fields (ACF) for the current user.
     *
     * This method retrieves the ACF fields for the current user and populates the corresponding properties
     * in the class instance. The ACF fields are retrieved using the user ID and stored in the instance variables
     * `intimacy_level`, `preferred_genres`, `preferred_scenes`, and `preferred_formats`.
     *
     * @throws \Exception if there is an error retrieving the ACF fields.
     * @return void
     */
    public function loadFromAcf(): void
    {
        $userId = $this->getUserId();
        $acfFields = get_fields('user_' . $userId);

        if ($acfFields) {
            $this->intimacy_level = $acfFields[self::INTIMACY_LEVEL];
            $this->preferred_genres = $acfFields[self::PREFERRED_GENRES];
            $this->preferred_scenes = $acfFields[self::PREFERRED_SCENES];
            $this->preferred_formats = $acfFields[self::PREFERRED_FORMATS];
        }
    }

    /**
     * Saves additional information for the user.
     *
     * This method saves the additional information for the user by updating the corresponding ACF fields.
     * The ACF fields that are updated include the intimacy level, preferred genres, preferred scenes,
     * preferred formats, and couple ID.
     *
     * @return void
     */
    public function saveAdditionalInformation(): void
    {
        $userId = $this->wp_user->ID;
        $acfFields = [
            self::INTIMACY_LEVEL => $this->intimacy_level,
            self::PREFERRED_GENRES => $this->preferred_genres,
            self::PREFERRED_SCENES => $this->preferred_scenes,
            self::PREFERRED_FORMATS => $this->preferred_formats,
            Couple::COUPLE_ID => $this->couple_id,
        ];

        update_field($acfFields, 'user_' . $userId);
    }
}
