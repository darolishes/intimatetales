<form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
    <label for="username">Username:</label>
    <input type="text" name="username" required>
    <label for="password">Password:</label>
    <input type="password" name="password" required>
    <input type="hidden" name="action" value="custom_login">
    <input type="submit" value="Login">
</form>