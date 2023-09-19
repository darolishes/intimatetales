<div id="roleplay-interface">
    <h2><?php the_title(); ?></h2>
    <div id="story-container">
        <?php the_content(); ?>
    </div>
    <div id="character-info">
        <h3>Your Character</h3>
        <p><?php echo $story_data['character_info']; ?></p>
    </div>
    <div id="roleplay-options">
        <h3>Choose Your Action</h3>
        <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
            <input type="hidden" name="action" value="roleplay_action">
            <input type="hidden" name="story_id" value="<?php the_ID(); ?>">
            <input type="hidden" name="user_id" value="<?php echo $current_user->ID; ?>">
            <select name="roleplay_choice">
                <?php foreach ($story_data['roleplay_choices'] as $choice) : ?>
                    <option value="<?php echo $choice; ?>"><?php echo $choice; ?></option>
                <?php endforeach; ?>
            </select>
            <input type="submit" value="Submit">
        </form>
    </div>
</div>