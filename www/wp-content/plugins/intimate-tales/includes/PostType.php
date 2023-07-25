<?php
namespace IntimateTales;

defined('ABSPATH') || exit;

/**
 * The PostType class.
 *
 * @since 1.0.0
 */
class PostType {
    protected $settings;

    /**
     * Construct the PostType instance.
     *
     * @param Settings $settings The settings object.
     */
    public function __construct(Settings $settings) {
        $this->settings = $settings;
    }

    /**
     * Register the custom post type.
     *
     * @since 1.0.0
     */
    public function register() {
        $labels = [
            'name'               => __('Intimate Tales', 'intimate-tales'),
            'singular_name'      => __('Intimate Tale', 'intimate-tales'),
        ];

        $args = [
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => 10,
            'supports'           => ['title', 'editor', 'thumbnail'],
        ];

        register_post_type($this->get_post_type(), $args);
    }

    /**
     * Get the post type slug.
     *
     * @since 1.0.0
     * @return string The post type slug.
     */
    public function get_post_type() {
        return $this->settings->get_post_type();
    }

    /**
     * Add custom rewrite rules.
     *
     * @since 1.0.0
     */
    public function add_rewrite_rules() {
        $post_type = $this->get_post_type();

        $slug = $this->settings->get_post_type_slug();
        $rewrite_slug = $slug . '/%intimate-tale%';

        add_rewrite_tag('%intimate-tale%', '([^/]+)', 'intimate-tale=');
        add_permastruct($post_type, $rewrite_slug, [
            'with_front' => false,
            'ep_mask' => EP_PERMALINK,
        ]);
    }
}
