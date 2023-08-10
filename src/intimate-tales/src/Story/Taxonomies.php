<?php

namespace IntimateTales;

class Taxonomies
{
    const TAX_GENRE = 'genre';
    const TAX_THEME = 'theme';
    const TAX_MOOD = 'mood';
    const TAX_SCENE = 'scene';
    const TAX_FORMAT = 'format';

    /**
     * Register the custom taxonomies.
     */
    public function register_taxonomies()
    {
        $taxonomies = array(
            array(
                'name' => self::TAX_GENRE,
                'post_type' => array(PostTypeRegistration::STORY),
                'labels' => array(
                    'name' => _x('Genres', 'taxonomy general name', 'intimate-tales'),
                    'singular_name' => _x('Genre', 'taxonomy singular name', 'intimate-tales'),
                )
            ),
            array(
                'name' => self::TAX_THEME,
                'post_type' => array(PostTypeRegistration::STORY),
                'labels' => array(
                    'name' => _x('Themes', 'taxonomy general name', 'intimate-tales'),
                    'singular_name' => _x('Theme', 'taxonomy singular name', 'intimate-tales'),
                )
            ),
            array(
                'name' => self::TAX_MOOD,
                'post_type' => array(PostTypeRegistration::STORY),
                'labels' => array(
                    'name' => _x('Moods', 'taxonomy general name', 'intimate-tales'),
                    'singular_name' => _x('Mood', 'taxonomy singular name', 'intimate-tales'),
                )
            ),
            // Neue Taxonomie für Szenen
            array(
                'name' => self::TAX_SCENE,
                'post_type' => array(PostTypeRegistration::STORY),
                'labels' => array(
                    'name' => _x('Scenes', 'taxonomy general name', 'intimate-tales'),
                    'singular_name' => _x('Scene', 'taxonomy singular name', 'intimate-tales'),
                )
            ),
            // Neue Taxonomie für Formate
            array(
                'name' => self::TAX_FORMAT,
                'post_type' => array(PostTypeRegistration::STORY),
                'labels' => array(
                    'name' => _x('Formats', 'taxonomy general name', 'intimate-tales'),
                    'singular_name' => _x('Format', 'taxonomy singular name', 'intimate-tales'),
                )
            ),
        );

        foreach ($taxonomies as $taxonomy) {
            $taxonomy_name = $taxonomy['name'];

            if (!taxonomy_exists($taxonomy_name)) {
                $default_args = array(
                    'hierarchical' => true,
                    'public' => true,
                    'show_ui' => true,
                    // Add other default arguments specific to this taxonomy
                );

                $args = wp_parse_args($taxonomy, $default_args);

                register_taxonomy($taxonomy_name, $taxonomy['post_type'], $args);
            }
        }
    }
}
