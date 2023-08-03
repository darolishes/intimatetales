<?php

namespace IntimateTales;

use WP_User;
use IntimateTales\UserFactory;
use InvalidArgumentException;

defined('ABSPATH') || exit;

class InvalidUserIdException extends \Exception
{
}
class UserAlreadyInCoupleException extends \Exception
{
}

class User
{
    const INTIMACY_LOW = 1;
    const INTIMACY_MEDIUM = 2;
    const INTIMACY_HIGH = 3;

    private const INTIMACY_LEVEL = 'intimacy_level';
    private const PREFERRED_GENRES = 'preferred_genres';
    private const PREFERRED_SCENES = 'preferred_scenes';
    private const PREFERRED_FORMATS = 'preferred_formats';

    private int $intimacy_level = self::INTIMACY_LOW;
    private array $preferred_genres = [];
    private array $preferred_scenes = [];
    private array $preferred_formats = [];
    private int $couple_id = 0;

    private WP_User $wp_user;

    private function __construct()
    {
    }

    /**
     * Get a User instance by the WP_User ID.
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
        $instance->getWpUser($wp_user);
        $instance->loadFromAcf();

        return $instance;
    }

    public function getUserId(): int
    {
        return $this->wp_user->ID;
    }

    public function getWpUser(): WP_User
    {
        if ($this->wp_user === null) {
            $this->wp_user = get_user_by('ID', $this->getUserId());
        }
        return $this->wp_user;
    }

    public function getIntimacyLevel(): int
    {
        return $this->intimacy_level;
    }

    public function getPreferredGenres(): array
    {
        return $this->preferred_genres;
    }

    public function getPreferredScenes(): array
    {
        return $this->preferred_scenes;
    }

    public function getPreferredFormats(): array
    {
        return $this->preferred_formats;
    }

    public function isCouple(): bool
    {
        return !empty($this->couple_id);
    }

    public function isPartOfCouple(): bool
    {
        $couple_id = get_field('couple_id', 'user_' . $this->wp_user->ID);
        return $couple_id !== false;
    }

    public function setIntimacyLevel(int $level): void
    {
        if ($level < self::INTIMACY_LOW || $level > self::INTIMACY_HIGH) {
            throw new InvalidArgumentException('Invalid intimacy level');
        }
        $this->intimacy_level = $level;
        update_field(self::INTIMACY_LEVEL, $level, 'user_' . $this->getUserId());
    }

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

    public function setPreferredScenes(array $scenes): void
    {
        $validScenes = get_terms([
            'taxonomy' => TaxonomyRegistration::TAX_SCENE,
            'hide_empty' => false,
            'fields' => 'slugs'
        ]);
        foreach ($scenes as $scene) {
            if (!in_array($scene, $validScenes)) {
                throw new InvalidArgumentException('Invalid scene: ' . $scene);
            }
        }
        $this->preferred_scenes = $scenes;
        update_field(self::PREFERRED_SCENES, $scenes, 'user_' . $this->getUserId());
    }

    public function setPreferredFormats(array $formats): void
    {
        $validFormats = get_terms([
            'taxonomy' => TaxonomyRegistration::TAX_FORMAT,
            'hide_empty' => false,
            'fields' => 'slugs'
        ]);
        foreach ($formats as $format) {
            if (!in_array($format, $validFormats)) {
                throw new InvalidArgumentException('Invalid format: ' . $format);
            }
        }
        $this->preferred_formats = $formats;
        update_field(self::PREFERRED_FORMATS, $formats, 'user_' . $this->getUserId());
    }

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
