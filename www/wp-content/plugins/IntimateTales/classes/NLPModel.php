<?php
namespace IntimateTales\Classes;

class NLPModel {
    /**
     * Generate a random narrative story.
     *
     * @return string The generated story text.
     */
    public function generate_story() {
        // Generate a random story using predefined templates or logic.
        $templates = array(
            'Once upon a time, there was a [adjective] [character].',
            'In a faraway land, [character] embarked on a journey to find [goal].',
            'Deep in the forest, [character] discovered a magical [object].',
        );

        // Randomly select a template and replace placeholders with random values.
        $story = $templates[array_rand($templates)];
        $story = str_replace('[adjective]', $this->get_random_adjective(), $story);
        $story = str_replace('[character]', $this->get_random_character(), $story);
        $story = str_replace('[goal]', $this->get_random_goal(), $story);

        return $story;
    }

    /**
     * Get a random adjective.
     *
     * @return string The random adjective.
     */
    private function get_random_adjective() {
        $adjectives = array('brave', 'mysterious', 'adventurous', 'curious', 'clever');
        return $adjectives[array_rand($adjectives)];
    }

    /**
     * Get a random character name.
     *
     * @return string The random character name.
     */
    private function get_random_character() {
        $characters = array('Alice', 'John', 'Ella', 'Max', 'Lily');
        return $characters[array_rand($characters)];
    }

    /**
     * Get a random goal or object.
     *
     * @return string The random goal or object.
     */
    private function get_random_goal() {
        $goals = array('the hidden treasure', 'true love', 'the lost artifact', 'inner peace');
        return $goals[array_rand($goals)];
    }
}
