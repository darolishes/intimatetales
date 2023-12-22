<?php
// Custom Post Types for IntimateTales Plugin

function create_cpts() {
    // Story Custom Post Type
    $story_labels = array(
        'name' => _x('Stories', 'Post Type General Name', 'intimatetales'),
        'singular_name' => _x('Story', 'Post Type Singular Name', 'intimatetales'),
        'menu_name' => __('Stories', 'intimatetales'),
        'name_admin_bar' => __('Story', 'intimatetales'),
        'archives' => __('Story Archives', 'intimatetales'),
        'attributes' => __('Story Attributes', 'intimatetales'),
        'parent_item_colon' => __('Parent Story:', 'intimatetales'),
        'all_items' => __('All Stories', 'intimatetales'),
        'add_new_item' => __('Add New Story', 'intimatetales'),
        'add_new' => __('Add New', 'intimatetales'),
        'new_item' => __('New Story', 'intimatetales'),
        'edit_item' => __('Edit Story', 'intimatetales'),
        'update_item' => __('Update Story', 'intimatetales'),
        'view_item' => __('View Story', 'intimatetales'),
        'view_items' => __('View Stories', 'intimatetales'),
        'search_items' => __('Search Story', 'intimatetales'),
        'not_found' => __('Not found', 'intimatetales'),
        'not_found_in_trash' => __('Not found in Trash', 'intimatetales'),
        'featured_image' => __('Featured Image', 'intimatetales'),
        'set_featured_image' => __('Set featured image', 'intimatetales'),
        'remove_featured_image' => __('Remove featured image', 'intimatetales'),
        'use_featured_image' => __('Use as featured image', 'intimatetales'),
        'insert_into_item' => __('Insert into story', 'intimatetales'),
        'uploaded_to_this_item' => __('Uploaded to this story', 'intimatetales'),
        'items_list' => __('Stories list', 'intimatetales'),
        'items_list_navigation' => __('Stories list navigation', 'intimatetales'),
        'filter_items_list' => __('Filter stories list', 'intimatetales'),
    );

    $story_args = array(
        'label' => __('Story', 'intimatetales'),
        'description' => __('Post Type Description', 'intimatetales'),
        'labels' => $story_labels,
        'supports' => array('title', 'editor', 'author', 'thumbnail', 'revisions'),
        'taxonomies' => array('category', 'post_tag'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'post',
    );

    register_post_type('story', $story_args);

    // Additional custom post types can be added here
}