<?php
namespace IntimateTales\Classes;

class ContentRegistration {
    const POST_TYPE_NAME = 'story';
    const TAXONOMY_CATEGORY = 'story_category';
    const TAXONOMY_TAG = 'story_tag';

    /**
     * Register the custom post type 'story'.
     */
    public static function register_story_post_type() {
        $labels = array(
            'name'                  => _x('Stories', 'Post type general name', 'intimate-tales'),
            'singular_name'         => _x('Story', 'Post type singular name', 'intimate-tales'),
            'menu_name'             => _x('Stories', 'Admin Menu text', 'intimate-tales'),
            'name_admin_bar'        => _x('Story', 'Add New on Toolbar', 'intimate-tales'),
            'add_new'               => __('Add New', 'intimate-tales'),
            'add_new_item'          => __('Add New Story', 'intimate-tales'),
            'new_item'              => __('New Story', 'intimate-tales'),
            'edit_item'             => __('Edit Story', 'intimate-tales'),
            'view_item'             => __('View Story', 'intimate-tales'),
            'all_items'             => __('All Stories', 'intimate-tales'),
            'search_items'          => __('Search Stories', 'intimate-tales'),
            'not_found'             => __('No stories found.', 'intimate-tales'),
            'not_found_in_trash'    => __('No stories found in Trash.', 'intimate-tales'),
            'featured_image'        => _x('Story Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'intimate-tales'),
            'set_featured_image'    => _x('Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'intimate-tales'),
            'remove_featured_image' => _x('Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'intimate-tales'),
            'use_featured_image'    => _x('Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'intimate-tales'),
            'archives'              => _x('Story archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'intimate-tales'),
        );

        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'menu_position'      => 5,
            'menu_icon'          => 'dashicons-book-alt',
            'capability_type'    => 'post',
            'has_archive'        => true,
            'supports'           => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'revisions', 'custom-fields'),
            'taxonomies'         => array(self::TAXONOMY_CATEGORY, self::TAXONOMY_TAG),
            'rewrite'            => array('slug' => 'story'),
        );

        register_post_type(self::POST_TYPE_NAME, $args);
    }

    /**
     * Register the custom taxonomies for the 'story' post type.
     */
    public static function register_story_taxonomies() {
        self::register_story_category_taxonomy();
        self::register_story_tag_taxonomy();
        // Add other taxonomies here if needed.
    }

    /**
     * Register the custom taxonomy 'story_category'.
     */
    private static function register_story_category_taxonomy() {
        $labels = array(
            'name'                       => _x('Categories', 'taxonomy general name', 'intimate-tales'),
            'singular_name'              => _x('Category', 'taxonomy singular name', 'intimate-tales'),
            'search_items'               => __('Search Categories', 'intimate-tales'),
            'all_items'                  => __('All Categories', 'intimate-tales'),
            'parent_item'                => __('Parent Category', 'intimate-tales'),
            'parent_item_colon'          => __('Parent Category:', 'intimate-tales'),
            'edit_item'                  => __('Edit Category', 'intimate-tales'),
            'update_item'                => __('Update Category', 'intimate-tales'),
            'add_new_item'               => __('Add New Category', 'intimate-tales'),
            'new_item_name'              => __('New Category Name', 'intimate-tales'),
            'menu_name'                  => __('Categories', 'intimate-tales'),
        );

        $args = array(
            'labels'                     => $labels,
            'hierarchical'               => true,
            'public'                     => true,
            'show_ui'                    => true,
            'show_admin_column'          => true,
            'show_in_nav_menus'          => true,
            'show_tagcloud'              => true,
        );

        register_taxonomy(self::TAXONOMY_CATEGORY, self::POST_TYPE_NAME, $args);
    }

    /**
     * Register the custom taxonomy 'story_tag'.
     */
    private static function register_story_tag_taxonomy() {
        $labels = array(
            'name'                       => _x('Tags', 'taxonomy general name', 'intimate-tales'),
            'singular_name'              => _x('Tag', 'taxonomy singular name', 'intimate-tales'),
            'search_items'               => __('Search Tags', 'intimate-tales'),
            'all_items'                  => __('All Tags', 'intimate-tales'),
            'edit_item'                  => __('Edit Tag', 'intimate-tales'),
            'update_item'                => __('Update Tag', 'intimate-tales'),
            'add_new_item'               => __('Add New Tag', 'intimate-tales'),
            'new_item_name'              => __('New Tag Name', 'intimate-tales'),
            'menu_name'                  => __('Tags', 'intimate-tales'),
        );

        $args = array(
            'labels'                     => $labels,
            'hierarchical'               => false,
            'public'                     => true,
            'show_ui'                    => true,
            'show_admin_column'          => true,
            'show_in_nav_menus'          => true,
            'show_tagcloud'              => true,
        );

        register_taxonomy(self::TAXONOMY_TAG, self::POST_TYPE_NAME, $args);
    }
}
