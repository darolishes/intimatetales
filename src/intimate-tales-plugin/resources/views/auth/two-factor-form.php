<!-- two-factor-form.php -->

<form action="<?php echo esc_url($action_url); ?>" method="post">
    <input type="hidden" name="_nonce" value="<?php echo esc_attr($nonce); ?>">
    ...
</form>