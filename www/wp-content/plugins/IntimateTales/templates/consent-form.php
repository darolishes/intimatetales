<form action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>" method="post">
    <label for="consent_checkbox">
        <input type="checkbox" name="consent_checkbox" id="consent_checkbox" required>
        <?php esc_html_e('I give my consent for data usage.', 'intimate-tales'); ?>
    </label>
    <?php wp_nonce_field('intimate_tales_consent_form', 'intimate_tales_nonce'); ?>
    <input type="hidden" name="intimate_tales_action" value="submit_consent_form">
    <button type="submit"><?php esc_html_e('Submit', 'intimate-tales'); ?></button>
</form>
