<?php
namespace IntimateTales\Models;

use WP_Comment;
use Exception;

class CommentModel extends Model
{
    protected WP_Comment $comment;

    public function __construct(WP_Comment $comment)
    {
        parent::__construct(['comment' => $comment]);
    }

    public static function find(int $id): static
    {
        $comment = get_comment($id);
        if (!$comment) {
            throw new Exception('Comment not found');
        }
        return new static($comment);
    }
}