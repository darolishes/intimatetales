<form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
    <label for="username">Username:</label>
    <input type="text" name="username" required>
    <label for="email">Email:</label>
    <input type="email" name="email" required>
    <label for="password">Password:</label>
    <input type="password" name="password" required>
    <input type="hidden" name="action" value="custom_signup">
    <input type="submit" value="Sign Up">
</form>