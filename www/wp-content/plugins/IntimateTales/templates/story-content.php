<div class="story-content">
    <p><?php echo $this->story_text; ?></p>
    <div class="decision-points">
        <p>What do you want to do next?</p>
        <?php foreach ($this->decision_points as $option => $text): ?>
            <button class="decision-btn" data-decision="<?php echo $option; ?>"><?php echo $text; ?></button>
        <?php endforeach; ?>
    </div>
</div>
