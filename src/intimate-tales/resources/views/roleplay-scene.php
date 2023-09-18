<div class="intimate-tales-roleplay-scene">
    <?php if (isset($scene_media)) : ?>
        <div class="scene-media">
            <?php echo $scene_media; ?>
        </div>
    <?php endif; ?>

    <!-- Scene content -->
    <div class="scene-content">
        <?php echo apply_filters('intimate_tales_scene_content', $scene_content); ?>
    </div>

    <!-- Choices for the user -->
    <div class="scene-choices">
        <ul>
            <?php foreach ($user_choices as $choice_id => $choice_text) : ?>
                <li>
                    <a href="<?php echo esc_url(add_query_arg('choice', $choice_id)); ?>">
                        <?php echo esc_html($choice_text); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <!-- Feedback/Comments -->
    <div class="scene-feedback">
        <h3><?php _e('Leave your feedback', 'intimate-tales'); ?></h3>
        <?php
        global $post;
        $post = get_post($scene_id);
        setup_postdata($post);

        comment_form();

        wp_reset_postdata();
        ?>
    </div>

</div>