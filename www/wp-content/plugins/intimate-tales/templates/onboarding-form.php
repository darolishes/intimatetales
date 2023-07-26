<!-- onboarding-form.php -->

<div class="onboarding-form">
    <!-- Implement the HTML form for user onboarding here -->
    <!-- Include input fields for collecting user information and preferences -->
    <!-- Use proper HTML form elements and form submission action -->
    <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post">
        <input type="hidden" name="action" value="intimate_tales_onboarding_submit">
        <!-- Include other form fields for user information and preferences -->
        <!-- For example: -->
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required>
        <!-- Include other form fields as needed -->

        <!-- Add a submit button -->
        <button type="submit">Start Role-Playing</button>
    </form>
</div>
