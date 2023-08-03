<?php

namespace IntimateTales;

class PostTypeRegistration
{
    const STORY = 'story';
    const COUPLE_CONNECTION = 'couple_connection';
    const ROLEPLAY = 'roleplay';

    /**
     * Register the custom post types.
     */
    public function register_post_types()
    {
        $post_types = [
            [
                'name' => self::COUPLE_CONNECTION,
                'label' => __('Couple Connection', 'intimate-tales'),
                'plural_label' => __('Couple Connections', 'intimate-tales'),
                'rewrite' => ['slug' => self::COUPLE_CONNECTION],
            ],
            [
                'name' => self::ROLEPLAY,
                'label' => __('Roleplay', 'intimate-tales'),
                'plural_label' => __('Roleplays', 'intimate-tales'),
                'rewrite' => ['slug' => self::ROLEPLAY],
            ],
            [
                'name' => self::STORY,
                'label' => __('Story', 'intimate-tales'),
                'plural_label' => __('Stories', 'intimate-tales'),
                'rewrite' => ['slug' => self::STORY],
                'taxonomies' => ['genre', 'theme', 'mood'],
            ]
        ];

        foreach ($post_types as $post_type_data) {
            $post_type_name = $post_type_data['name'];

            // Check if post type already exists
            if (!post_type_exists($post_type_name)) {
                $default_args = [
                    'labels' => [
                        'name' => $post_type_data['plural_label'],
                        'singular_name' => $post_type_data['label'],
                    ],
                    'public' => true,
                    'has_archive' => true,
                    'supports' => ['title', 'editor', 'thumbnail', 'author', 'revisions'],
                    'show_in_rest' => true,
                ];

                // Merge and override default arguments
                $args = wp_parse_args($post_type_data, $default_args);

                // Register the post type with merged arguments
                register_post_type($post_type_name, $args);
            }
        }
    }
}
