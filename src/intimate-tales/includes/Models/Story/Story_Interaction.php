<?php

namespace IntimateTales\Models\Story;

defined( 'ABSPATH' ) || exit;

/**
 * Class responsible for managing user interactions with stories.
 */
class Story_Interaction {

	/**
	 * @var string
	 */
	private const LIKES_FIELD_KEY     = 'story_likes';
	private const FAVORITES_FIELD_KEY = 'story_favorites';
	private const SHARES_FIELD_KEY    = 'story_shares';

	/**
	 * Increment the like count for a given story.
	 *
	 * @param int $storyId
	 * @param int $userId
	 */
	public function like_story( int $storyId, int $userId ): void {
		$this->increment_field( $storyId, self::LIKES_FIELD_KEY );
	}

	/**
	 * Increment the favorite count for a given story.
	 *
	 * @param int $storyId
	 * @param int $userId
	 */
	public function add_story_to_favorites( int $storyId, int $userId ): void {
		$this->increment_field( $storyId, self::FAVORITES_FIELD_KEY );
	}

	/**
	 * Increment the share count for a given story.
	 *
	 * @param int $storyId
	 * @param int $userId
	 */
	public function share_story( int $storyId, int $userId ): void {
		$this->increment_field( $storyId, self::SHARES_FIELD_KEY );
	}

	/**
	 * Generic function to increment a given field for a story.
	 *
	 * @param int    $storyId
	 * @param string $fieldKey
	 */
	private function increment_field( int $storyId, string $fieldKey ): void {
		$count = intval( get_field( $fieldKey, $storyId ) );
		$count++;
		update_field( $fieldKey, $count, $storyId );
	}

	/**
	 * Add a comment to a story and associate a rating with the comment.
	 *
	 * @param int    $storyId
	 * @param int    $userId
	 * @param string $comment
	 * @param int    $rating
	 */
	public function comment_on_story( int $storyId, int $userId, string $comment, int $rating ): void {
		$commentdata = array(
			'comment_post_ID' => $storyId,
			'comment_author'  => $userId,
			'comment_content' => $comment,
			'comment_type'    => '',
			'comment_parent'  => 0,
			'user_id'         => $userId,
		);

		$commentId = wp_new_comment( $commentdata );

		if ( $commentId ) {
			add_comment_meta( $commentId, 'rating', $rating );
		}
	}
}
