<?php
namespace IntimateTales;

use IntimateTales\PostTypeRegistration;

class TaxonomyRegistration {
    const TAXONOMY_CATEGORY = 'story_category';
    const TAXONOMY_TAG = 'story_tag';

    /**
     * Register the custom taxonomies.
     */
    public function register_taxonomies() {
        $taxonomies = array(
            $this->getCategoryTaxonomy(),
            $this->getTagTaxonomy()
        );

        foreach ($taxonomies as $taxonomy) {
            if (!taxonomy_exists($taxonomy['name'])) {
                register_taxonomy($taxonomy['name'], $taxonomy['post_type'], $taxonomy['args']);
            }
        }
    }

    /**
     * Get the definition for the category taxonomy.
     */
    private function getCategoryTaxonomy() {
        return array(
            'name' => self::TAXONOMY_CATEGORY,
            'labels' => array(
                'name' => _x('Categories', 'taxonomy general name', 'intimate-tales'),
                'singular_name' => _x('Category', 'taxonomy singular name', 'intimate-tales'),
                // ... Weitere Label-Einstellungen ...
            ),
            'post_type' => array(PostTypeRegistration::POST_TYPE_NAME_STORY),
            'args' => array(
                'hierarchical' => true,
                'public' => true,
                'show_ui' => true,
                // ... Weitere Taxonomy-Optionen ...
            ),
        );
    }

    /**
     * Get the definition for the tag taxonomy.
     */
    private function getTagTaxonomy() {
        return array(
            'name' => self::TAXONOMY_TAG,
            'labels' => array(
                'name' => _x('Tags', 'taxonomy general name', 'intimate-tales'),
                'singular_name' => _x('Tag', 'taxonomy singular name', 'intimate-tales'),
                // ... Weitere Label-Einstellungen ...
            ),
            'post_type' => array(PostTypeRegistration::POST_TYPE_NAME_STORY),
            'args' => array(
                'hierarchical' => false,
                'public' => true,
                'show_ui' => true,
                // ... Weitere Taxonomy-Optionen ...
            ),
        );
    }
}
