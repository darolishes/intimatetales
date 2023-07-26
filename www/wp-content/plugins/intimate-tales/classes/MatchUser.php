<?php
namespace IntimateTales;

// Exit if accessed directly.
defined('ABSPATH') || exit;

/**
 * Class MatchUser
 * Handles partner matching logic based on user preferences.
 */
class MatchUser {
    /**
     * User object representing the current user for matching.
     *
     * @var User
     */
    private $user;

    /**
     * Array of User objects representing potential partners.
     *
     * @var array
     */
    private $potentialPartners;

    /**
     * MatchUser constructor.
     *
     * @param User $user The user for whom the matching should be performed.
     * @param array $potentialPartners An array of User objects representing potential partners.
     */
    public function __construct(User $user, array $potentialPartners) {
        $this->user = $user;
        $this->potentialPartners = $potentialPartners;
    }

    /**
     * Matches a user with potential partners based on their intimacy level and preferences.
     *
     * @return array An array of User objects representing the matched partners.
     */
    public function match() {
        // Initialize an empty array to store matched partners.
        $matchedPartners = array();

        // Get the user's intimacy level and desired scenarios for matching.
        $userIntimacyLevel = $this->user->getIntimacyLevel();
        $userDesiredScenarios = $this->user->getDesiredScenarios();

        // Loop through potential partners and match based on preferences.
        foreach ($this->potentialPartners as $potentialPartner) {
            // Check if the potential partner's intimacy level and desired scenarios match the user's preferences.
            $partnerIntimacyLevel = $potentialPartner->getIntimacyLevel();
            $partnerDesiredScenarios = $potentialPartner->getDesiredScenarios();

            // Perform matching logic here...
            if ($partnerIntimacyLevel >= $userIntimacyLevel && self::scenariosMatch($userDesiredScenarios, $partnerDesiredScenarios)) {
                // If the partner's intimacy level is higher or equal, and desired scenarios match, add to matched partners.
                $matchedPartners[] = $potentialPartner;
            }
        }

        return $matchedPartners;
    }

    /**
     * Checks if two sets of desired scenarios match.
     *
     * @param string $userDesiredScenarios Desired scenarios of the user.
     * @param string $partnerDesiredScenarios Desired scenarios of the potential partner.
     * @return bool True if desired scenarios match, false otherwise.
     */
    private static function scenariosMatch($userDesiredScenarios, $partnerDesiredScenarios) {
        // Perform the desired scenarios matching logic here...
        // For example, you can check if both sets of desired scenarios have at least one common scenario.
        // You can implement any matching logic based on your requirements.
        // For simplicity, let's assume that scenarios match if they are the same.

        return $userDesiredScenarios === $partnerDesiredScenarios;
    }

    /**
     * Find a suitable partner for the user.
     *
     * @return int|null The ID of the suitable partner, or null if no suitable partner is found.
     */
    public function findSuitablePartner() {
        $suitable_partner_id = null;
        $suitable_partner_score = 0;

        // Get all other users
        $users = get_users();

        // Iterate through each user to find a suitable partner
        foreach ($users as $user) {
            // Skip the current user (self)
            if ($user->ID === $this->user->getID()) {
                continue;
            }

            // Get the partner's intimacy level and desired scenarios
            $partner_intimacy_level = absint(get_user_meta($user->ID, 'intimacy_level', true));
            $partner_desired_scenarios = sanitize_text_field(get_user_meta($user->ID, 'desired_scenarios', true));

            // Calculate a score for partner compatibility based on intimacy level and desired scenarios
            $compatibility_score = 0;
            if ($partner_intimacy_level === $this->user->getIntimacyLevel()) {
                $compatibility_score += 1;
            }

            $common_scenarios = array_intersect(explode(',', $partner_desired_scenarios), explode(',', $this->user->getDesiredScenarios()));
            $compatibility_score += count($common_scenarios);

            // Update the suitable partner if the current partner has a higher compatibility score
            if ($compatibility_score > $suitable_partner_score) {
                $suitable_partner_id = $user->ID;
                $suitable_partner_score = $compatibility_score;
            }
        }

        return $suitable_partner_id;
    }
}
