<?php

namespace BooksManagement\Taxonomies;

class AuthorTaxonomy {
    public static function register() {
        add_action('init', [__CLASS__, 'register_taxonomy']);
    }

    public static function register_taxonomy() {
        $labels = [
            'name' => __('Authors', 'books-management'),
            'singular_name' => __('Author', 'books-management'),
        ];

        $args = [
            'labels' => $labels,
            'hierarchical' => false,
            'public' => true,
            'show_in_rest' => true,
        ];

        register_taxonomy('author', 'book', $args);
    }
}
