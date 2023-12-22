// JavaScript for IntimateTales WordPress plugin

// Ensure jQuery is available
if (typeof jQuery === 'undefined') {
    throw new Error('IntimateTales requires jQuery');
}

jQuery(document).ready(function($) {
    // Login form submission
    $('#login_form').on('submit', function(e) {
        e.preventDefault();
        var formData = $(this).serialize();

        // AJAX request for user authentication
        $.ajax({
            url: IntimateTalesAjax.ajaxurl,
            type: 'POST',
            data: formData + '&action=intimatetales_authenticate_user',
            success: function(response) {
                if(response.success) {
                    alert('Login successful.');
                    // Redirect or update UI as needed
                } else {
                    alert('Login failed. Please check your credentials.');
                }
            }
        });
    });

    // Registration form submission
    $('#registration_form').on('submit', function(e) {
        e.preventDefault();
        var formData = $(this).serialize();

        // AJAX request for user registration
        $.ajax({
            url: IntimateTalesAjax.ajaxurl,
            type: 'POST',
            data: formData + '&action=intimatetales_register_user',
            success: function(response) {
                if(response.success) {
                    alert('Registration successful.');
                    // Redirect or update UI as needed
                } else {
                    alert('Registration failed. Please try again.');
                }
            }
        });
    });

    // Fetch stories
    $('#story_container').on('load', function() {
        // AJAX request for fetching stories
        $.ajax({
            url: IntimateTalesAjax.ajaxurl,
            type: 'GET',
            data: {
                action: 'intimatetales_fetch_stories'
            },
            success: function(response) {
                if(response.success) {
                    $('#story_container').html(response.data);
                } else {
                    alert('Failed to load stories.');
                }
            }
        });
    });

    // Save user preferences
    $('#user_profile').on('change', 'input, select', function() {
        var preferences = $(this).closest('form').serialize();

        // AJAX request for saving user preferences
        $.ajax({
            url: IntimateTalesAjax.ajaxurl,
            type: 'POST',
            data: preferences + '&action=intimatetales_save_preferences',
            success: function(response) {
                if(response.success) {
                    alert('Preferences saved.');
                } else {
                    alert('Failed to save preferences.');
                }
            }
        });
    });

    // Other event listeners and functions as needed for the IntimateTales plugin
});
