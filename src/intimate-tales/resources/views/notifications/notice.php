<div style="background-color: #ffeb3b; padding: 15px; border-radius: 5px;">
    <?php echo $args['message']; ?>
    <?php if (isset($args['button']) && !empty($args['button'])) : ?>
        <div style="margin-top: 10px;">
            <?php echo $args['button']; ?>
        </div>
    <?php endif; ?>
</div>