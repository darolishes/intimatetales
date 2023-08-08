<!-- Story Page -->
<div>
    <!-- Display the generated story -->
    <?php echo $generated_story; ?>
    <!-- Form fields for user decisions -->
    <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
        <input type="hidden" name="action" value="intimate_tales_handle_story_decision">
        <?php wp_nonce_field('intimate_tales_story_decision_nonce', 'intimate_tales_nonce'); ?>
        <!-- Decision points will be added here -->
        <input type="submit" value="Submit Decision">
    </form>
</div>
