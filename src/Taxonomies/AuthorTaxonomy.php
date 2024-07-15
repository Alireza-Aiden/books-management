<?php

namespace BooksManagement\Taxonomies;

class AuthorTaxonomy
{
    public function register()
    {
        add_action('init', [$this, 'registerTaxonomy']);
    }

    public function registerTaxonomy()
    {
        $labels = [
            'name'                       => _x('Authors', 'taxonomy general name', 'books-management'),
            'singular_name'              => _x('Author', 'taxonomy singular name', 'books-management'),
            'search_items'               => __('Search Authors', 'books-management'),
            'popular_items'              => __('Popular Authors', 'books-management'),
            'all_items'                  => __('All Authors', 'books-management'),
            'parent_item'                => null,
            'parent_item_colon'          => null,
            'edit_item'                  => __('Edit Author', 'books-management'),
            'update_item'                => __('Update Author', 'books-management'),
            'add_new_item'               => __('Add New Author', 'books-management'),
            'new_item_name'              => __('New Author Name', 'books-management'),
            'separate_items_with_commas' => __('Separate authors with commas', 'books-management'),
            'add_or_remove_items'        => __('Add or remove authors', 'books-management'),
            'choose_from_most_used'      => __('Choose from the most used authors', 'books-management'),
            'menu_name'                  => __('Authors', 'books-management'),
        ];

        $args = [
            'hierarchical'          => false,
            'labels'                => $labels,
            'show_ui'               => true,
            'show_admin_column'     => true,
            'update_count_callback' => '_update_post_term_count',
            'query_var'             => true,
            'rewrite'               => ['slug' => 'book-author'],
        ];

        register_taxonomy('book_author', 'book', $args);
    }
}