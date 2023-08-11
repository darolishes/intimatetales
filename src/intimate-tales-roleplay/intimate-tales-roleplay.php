<?php

/**
 * Plugin Name: Intimate Tales - Rollenspiel Modul
 * Description: Ein Rollenspiel-Modul für das Haupt-Plugin "Intimate Tales".
 * Version: 1.0.0
 * Author: [Your Name or Company]
 * Text Domain: intimate-tales-rollenspiel
 */

// Ensure direct access is blocked
if (!defined('ABSPATH')) {
    exit;
}

// Check if the main "Intimate Tales" plugin is active
if (!class_exists('IntimateTales')) {
    add_action('admin_notices', function () {
        echo '<div class="notice notice-error is-dismissible"><p>"Intimate Tales - Rollenspiel Modul" benötigt das Haupt-Plugin "Intimate Tales" um korrekt zu funktionieren.</p></div>';
    });
    return;
}
// Instantiate the Rollenspiel class and other necessary classes
$rollenspiel = new IntimateTales\Roleplay\Roleplay(get_current_user_id(), get_the_ID());

// Hook into the the_content filter to modify the story content based on user decisions and interactions
add_filter('the_content', function ($content) {
    global $post;

    // Check if the content is of type 'story'
    if ($post->post_type !== 'story') {
        return $content;
    }

    // Load decisions and interactions for the user
    // This is a placeholder and can be replaced with actual logic
    $decisions = $rollenspiel->load_game();

    // Modify the content based on decisions
    // This is a placeholder and can be replaced with actual logic
    $modified_content = $content . "<div class='rollenspiel-decisions'>" . implode(', ', $decisions) . "</div>";

    return $modified_content;
});

// AJAX endpoint to save user decisions
add_action('wp_ajax_save_decision', function () {
    // Get the decision data from the AJAX request
    $decision_data = isset($_POST['decision']) ? $_POST['decision'] : null;

    // Placeholder logic to save the decision
    // This can be replaced with actual logic to save the decision in the database
    $result = $rollenspiel->save_decision($decision_data);

    // Return a JSON response
    echo json_encode(array('success' => true, 'data' => $result));
    exit;
});

// AJAX endpoint to load user decisions (this can be expanded further)
add_action('wp_ajax_load_decision', function () {
    // Placeholder logic to load the decision
    // This can be replaced with actual logic to load the decision from the database
    $decisions = $rollenspiel->load_game();

    // Return a JSON response
    echo json_encode(array('success' => true, 'data' => $decisions));
    exit;
});
