<?php

namespace BooksManagement\Taxonomies;

class PublisherTaxonomy {
    public static function register() {
        add_action('init', [__CLASS__, 'register_taxonomy']);
    }

    public static function register_taxonomy() {
        $labels = [
            'name' => __('Publishers', 'books-management'),
            'singular_name' => __('Publisher', 'books-management'),
        ];

        $args = [
            'labels' => $labels,
            'hierarchical' => true,
            'public' => true,
            'show_in_rest' => true,
        ];

        register_taxonomy('publisher', 'book', $args);
    }
}
