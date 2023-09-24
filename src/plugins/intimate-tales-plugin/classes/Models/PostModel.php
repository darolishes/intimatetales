<?php
namespace IntimateTales\Models;

use Exception;
use WP_Post;

class PostModel extends Model
{
    protected WP_Post $post;

    public function __construct(WP_Post $post)
    {
        parent::__construct(['post' => $post]);
        $this->load_meta();
        $this->load_terms();
    }

    protected function load_meta(): void
    {
        $this->meta = get_post_meta($this->post->ID, null);
    }

    protected function load_terms(): void
    {
        $this->terms = get_the_terms($this->post->ID, static::POST_TYPE);
    }

    public function get_terms(): array
    {
        return $this->terms ?? [];
    }

    public static function find(int $id): static
    {
        $post = get_post($id);
        if (!$post) {
            throw new Exception('Post not found');
        }
        return new static($post);
    }

    public static function all(): array
    {
        $posts = get_posts(['numberposts' => -1]);
        return array_map(fn($post) => new static($post), $posts);
    }
}