<?php
namespace IntimateTales;

defined('ABSPATH') || exit;

/**
 * The Taxonomy class.
 *
 * @since 1.0.0
 */
class Taxonomy {
    protected $post_type;
    protected $settings;

    /**
     * Construct the Taxonomy instance.
     *
     * @param string   $post_type The post type.
     * @param Settings $settings  The settings object.
     */
    public function __construct(Settings $settings) {
        $this->settings = $settings;
        $this->post_type = $settings->get_post_type();
    }

    /**
     * Register the custom taxonomy.
     *
     * @since 1.0.0
     */
    public function register() {
        $labels = [
            'name'                       => __('Roleplay Categories', 'intimate-tales'),
            'singular_name'              => __('Roleplay Category', 'intimate-tales'),
            'menu_name'                  => __('Categories', 'intimate-tales'),
            'all_items'                  => __('All Categories', 'intimate-tales'),
            'edit_item'                  => __('Edit Category', 'intimate-tales'),
            'view_item'                  => __('View Category', 'intimate-tales'),
            'update_item'                => __('Update Category', 'intimate-tales'),
            'add_new_item'               => __('Add New Category', 'intimate-tales'),
            'new_item_name'              => __('New Category Name', 'intimate-tales'),
            'parent_item'                => __('Parent Category', 'intimate-tales'),
            'parent_item_colon'          => __('Parent Category:', 'intimate-tales'),
            'search_items'               => __('Search Categories', 'intimate-tales'),
            'popular_items'              => __('Popular Categories', 'intimate-tales'),
            'separate_items_with_commas' => __('Separate categories with commas', 'intimate-tales'),
            'add_or_remove_items'        => __('Add or remove categories', 'intimate-tales'),
            'choose_from_most_used'      => __('Choose from the most used categories', 'intimate-tales'),
            'not_found'                  => __('No categories found', 'intimate-tales'),
            'back_to_items'              => __('Back to Categories', 'intimate-tales'),
        ];

        $args = [
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => ['slug' => $this->settings->get_taxonomy_slug()],
        ];

        register_taxonomy($this->get_taxonomy(), $this->post_type, $args);
    }

    /**
     * Get the taxonomy slug.
     *
     * @since 1.0.0
     * @return string The taxonomy slug.
     */
    public function get_taxonomy() {
        return $this->settings->get_taxonomy_slug();
    }
}
