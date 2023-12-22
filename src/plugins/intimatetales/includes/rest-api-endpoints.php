<?php
// Rest API Endpoints for IntimateTales Plugin

// Function to register custom REST API routes
function register_rest_routes() {
    // Register route for user authentication
    register_rest_route('intimatetales/v1', '/authenticate', array(
        'methods' => 'POST',
        'callback' => 'authenticate_user',
        'permission_callback' => '__return_true'
    ));

    // Register route for fetching stories
    register_rest_route('intimatetales/v1', '/stories', array(
        'methods' => 'GET',
        'callback' => 'fetch_stories',
        'permission_callback' => '__return_true'
    ));

    // Register route for saving user preferences
    register_rest_route('intimatetales/v1', '/preferences', array(
        'methods' => 'POST',
        'callback' => 'save_user_preferences',
        'permission_callback' => '__return_true'
    ));

    // Register route for updating user profile
    register_rest_route('intimatetales/v1', '/profile', array(
        'methods' => 'POST',
        'callback' => 'update_user_profile',
        'permission_callback' => '__return_true'
    ));
}

// Callback functions for the REST API routes

// User authentication callback
function authenticate_user(WP_REST_Request $request) {
    // Extract data from request
    $username = $request->get_param('username');
    $password = $request->get_param('password');

    // Authentication logic
    // ...

    return new WP_REST_Response(array('message' => 'UserAuthenticationSuccess'), 200);
}

// Fetch stories callback
function fetch_stories(WP_REST_Request $request) {
    // Fetching stories logic
    // ...

    return new WP_REST_Response(array('message' => 'StoryFetchSuccess'), 200);
}

// Save user preferences callback
function save_user_preferences(WP_REST_Request $request) {
    // Extract and save preferences
    // ...

    return new WP_REST_Response(array('message' => 'PreferencesSaved'), 200);
}

// Update user profile callback
function update_user_profile(WP_REST_Request $request) {
    // Extract and update user profile
    // ...

    return new WP_REST_Response(array('message' => 'UserProfileUpdated'), 200);
}