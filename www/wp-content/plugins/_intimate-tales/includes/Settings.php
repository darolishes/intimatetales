<?php
namespace IntimateTales;

defined('ABSPATH') || exit;

/**
 * The Settings class.
 *
 * @since 1.0.0
 */
class Settings {
    /**
     * The post type.
     *
     * @since 1.0.0
     * @var string $post_type The post type.
     */
    private $post_type = 'intimate-tale';

    /**
     * The post type slug.
     *
     * @since 1.0.0
     * @var string $post_type_slug The post type slug.
     */
    public $post_type_slug = 'intimate-tale';

    /**
     * The taxonomy slug.
     *
     * @since 1.0.0
     * @var string $taxonomy_slug The taxonomy slug.
     */
    public $taxonomy_slug = 'intimate-tale-category';

    /**
     * The post type rewrite.
     *
     * @since 1.0.0
     * @var string $post_type_rewrite The post type rewrite.
     */
    public $post_type_rewrite = 'intimate-tales';

    /**
     * The meta key for storing the story author.
     *
     * @since 1.0.0
     * @var string $author_meta_key The meta key for story author.
     */
    public $author_meta_key = '_intimate_tale_author';

    /**
     * Get the post type.
     *
     * @since 1.0.0
     * @return string The post type.
     */
    public function get_post_type() {
        return $this->post_type;
    }

    /**
     * Get the post type slug.
     *
     * @since 1.0.0
     * @return string The post type slug.
     */
    public function get_post_type_slug() {
        return $this->post_type_slug;
    }

    /**
     * Get the taxonomy slug.
     *
     * @since 1.0.0
     * @return string The taxonomy slug.
     */
    public function get_taxonomy_slug() {
        return $this->taxonomy_slug;
    }

    /**
     * Get the post type rewrite.
     *
     * @since 1.0.0
     * @return string The post type rewrite.
     */
    public function get_post_type_rewrite() {
        return $this->post_type_rewrite;
    }

    /**
     * Get the meta key for story author.
     *
     * @since 1.0.0
     * @return string The author meta key.
     */
    public function get_author_meta_key() {
        return $this->author_meta_key;
    }
}
