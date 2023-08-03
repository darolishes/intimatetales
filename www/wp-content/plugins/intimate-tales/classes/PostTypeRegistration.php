<?php
namespace IntimateTales;

class PostTypeRegistration {
    const POST_TYPE_NAME_STORY = 'story';
    const POST_TYPE_NAME_COUPLE_CONNECTION = 'couple_connection';
    const POST_TYPE_NAME_ROLEPLAY = 'roleplay';

    /**
     * Register the custom post types.
     */
    public function register_post_types() {
        $post_types = array(
            array(
                'name' => self::POST_TYPE_NAME_COUPLE_CONNECTION,
                'labels' => array(
                    'name' => __('Couple Connections', 'intimate-tales'),
                    'singular_name' => __('Couple Connection', 'intimate-tales'),
                ),
            ),
            array(
                'name' => self::POST_TYPE_NAME_ROLEPLAY,
                'labels' => array(
                    'name' => __('Roleplays', 'intimate-tales'),
                    'singular_name' => __('Roleplay', 'intimate-tales'),
                ),
            ),
            array(
                'name' => self::POST_TYPE_NAME_STORY,
                'labels' => array(
                    'name' => __('Stories', 'intimate-tales'),
                    'singular_name' => __('Story', 'intimate-tales'),
                ),
            )
        );

        foreach ($post_types as $post_type) {
            if (!post_type_exists($post_type['name'])) {
                register_post_type($post_type['name'], array(
                    'labels' => $post_type['labels'],
                    'public' => true,
                    'has_archive' => true,
                    'supports' => array('title', 'editor', 'thumbnail', 'author', 'revisions'),
                    'show_in_rest' => true,
                    'rewrite' => array('slug' => $post_type['name']),
                ));
            }
        }
    }
}
