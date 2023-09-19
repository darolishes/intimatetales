<form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
    <label for="email">Email:</label>
    <input type="email" name="email" required>
    <input type="hidden" name="action" value="custom_pw_reset">
    <input type="submit" value="Reset Password">
</form>