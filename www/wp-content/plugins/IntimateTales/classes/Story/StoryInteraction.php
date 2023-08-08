<?php

namespace IntimateTales\Story;

class StoryInteraction
{
    private const LIKES_FIELD_KEY = 'story_likes'; // Replace with the actual key
    private const FAVORITES_FIELD_KEY = 'story_favorites'; // Replace with the actual key
    private const SHARES_FIELD_KEY = 'story_shares'; // Replace with the actual key

    public function likeStory(int $storyId, int $userId): void
    {
        $this->incrementField($storyId, self::LIKES_FIELD_KEY);
    }

    public function addStoryToFavorites(int $storyId, int $userId): void
    {
        $this->incrementField($storyId, self::FAVORITES_FIELD_KEY);
    }

    public function shareStory(int $storyId, int $userId): void
    {
        $this->incrementField($storyId, self::SHARES_FIELD_KEY);
    }

    private function incrementField(int $storyId, string $fieldKey): void
    {
        $count = intval(get_field($fieldKey, $storyId));
        $count++;
        update_field($fieldKey, $count, $storyId);
    }

    public function commentOnStory(int $storyId, int $userId, string $comment, int $rating): void
    {
        $commentdata = array(
            'comment_post_ID' => $storyId,
            'comment_author' => $userId,
            'comment_content' => $comment,
            'comment_type' => '',
            'comment_parent' => 0,
            'user_id' => $userId,
        );

        $commentId = wp_new_comment($commentdata);
        if ($commentId) {
            add_comment_meta($commentId, 'rating', $rating);
        }
    }
}
