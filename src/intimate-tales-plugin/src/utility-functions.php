<?php

/**
 * Utility Functions for IntimateTales Plugin
 *
 * This file contains a set of utility functions that will be used across the IntimateTales Plugin.
 * These functions have been added to centralize common functionalities and maintain cleaner code.
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Convert string to snake_case.
 *
 * @param string $string Input string.
 * @return string Snake cased string.
 */
function it_convert_to_snake_case($string)
{
    // Replace spaces with underscores and convert to lowercase.
    return strtolower(preg_replace('/\s+/', '_', $string));
}

/**
 * Fetch user by meta data.
 *
 * @param string $meta_key Meta key to search for.
 * @param string $meta_value Meta value to search for.
 * @return WP_User|false Returns a WP_User object on success, false on failure.
 */
function it_get_user_by_meta($meta_key, $meta_value)
{
    // Use WP Query to fetch users by meta data.
    $users = get_users(
        array(
            'meta_key'     => $meta_key,
            'meta_value'   => $meta_value,
            'number'       => 1,
            'count_total'  => false
        )
    );

    // Return first user if found.
    return !empty($users) ? $users[0] : false;
}

/**
 * Validate story content.
 *
 * @param string $content Story content.
 * @return bool True if valid, false otherwise.
 */
function it_validate_story_content($content)
{
    // For this example, let's say a valid story content should be between 100 to 10000 characters.
    if (strlen($content) < 100 || strlen($content) > 10000) {
        return false;
    }
    return true;
}

/**
 * Fetch premium content price.
 *
 * @param int $content_id ID of the premium content.
 * @return float|false Price of the premium content or false if not found.
 */
function it_get_premium_content_price($content_id)
{
    // Use WordPress function to fetch post meta.
    $price = get_post_meta($content_id, '_it_premium_content_price', true);

    // Return price if found and is numeric.
    return is_numeric($price) ? (float) $price : false;
}
