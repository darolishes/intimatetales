<?php
namespace IntimateTales;

// Exit if accessed directly.
defined('ABSPATH') || exit;

/**
 * Class MatchUser
 * Handles partner matching logic based on user preferences.
 */
class MatchUser {
    private $user;
    private $potentialPartners;

    public function __construct(User $user, array $potentialPartners) {
        $this->user = $user;
        $this->potentialPartners = $potentialPartners;
    }

    public function match() {
        $matchedPartners = array();
        $userIntimacyLevel = $this->user->getIntimacyLevel();
        $userDesiredScenariosArray = explode(',', $this->user->getDesiredScenarios());

        foreach ($this->potentialPartners as $potentialPartner) {
            $partnerIntimacyLevel = $potentialPartner->getIntimacyLevel();
            $partnerDesiredScenariosArray = explode(',', $potentialPartner->getDesiredScenarios());

            if ($partnerIntimacyLevel >= $userIntimacyLevel && self::scenariosMatch($userDesiredScenariosArray, $partnerDesiredScenariosArray)) {
                $matchedPartners[] = $potentialPartner;
            }
        }

        return $matchedPartners;
    }

    private static function scenariosMatch($userDesiredScenariosArray, $partnerDesiredScenariosArray) {
        return !empty(array_intersect($userDesiredScenariosArray, $partnerDesiredScenariosArray));
    }

    public function findSuitablePartner() {
        $suitable_partner_id = null;
        $suitable_partner_score = 0;

        // Define WP_User_Query arguments to get users based on certain criteria
        $args = array(
            'exclude' => array($this->user->getID()),
            'meta_query' => array(
                'relation' => 'AND',
                array(
                    'key' => 'intimacy_level',
                    'value' => $this->user->getIntimacyLevel(),
                    'compare' => '='
                ),
                array(
                    'key' => 'desired_scenarios',
                    'value' => $this->user->getDesiredScenarios(),
                    'compare' => 'LIKE'
                )
            )
        );

        $user_query = new \WP_User_Query($args);

        $userIntimacyLevel = $this->user->getIntimacyLevel();
        $userDesiredScenariosArray = explode(',', $this->user->getDesiredScenarios());

        if (!empty($user_query->get_results())) {
            foreach ($user_query->get_results() as $user) {
                $partner_intimacy_level = absint(get_user_meta($user->ID, 'intimacy_level', true));
                $partner_desired_scenarios_array = explode(',', sanitize_text_field(get_user_meta($user->ID, 'desired_scenarios', true)));

                $compatibility_score = 0;
                if ($partner_intimacy_level === $userIntimacyLevel) {
                    $compatibility_score += 1;
                }

                $common_scenarios = array_intersect($partner_desired_scenarios_array, $userDesiredScenariosArray);
                $compatibility_score += count($common_scenarios);

                if ($compatibility_score > $suitable_partner_score) {
                    $suitable_partner_id = $user->ID;
                    $suitable_partner_score = $compatibility_score;
                }
            }
        }

        return $suitable_partner_id;
    }
}