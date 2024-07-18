<?php

namespace BooksManagement\PostType;

class BookPostType {
    public static function register() {
        add_action('init', [__CLASS__, 'register_post_type']);
    }

    public static function register_post_type() {
        $labels = [
            'name' => __('Books', 'books-management'),
            'singular_name' => __('Book', 'books-management'),
        ];

        $args = [
            'labels' => $labels,
            'public' => true,
            'has_archive' => true,
            'supports' => ['title', 'editor', 'thumbnail'],
            'show_in_rest' => true,
            'taxonomies' => ['author', 'publisher'],
        ];

        register_post_type('book', $args);
    }
}
