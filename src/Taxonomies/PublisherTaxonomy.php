<?php

namespace BooksManagement\Taxonomies;

class PublisherTaxonomy
{
    public function register()
    {
        add_action('init', [$this, 'registerTaxonomy']);
    }

    public function registerTaxonomy()
    {
        $labels = [
            'name'                       => _x('Publishers', 'taxonomy general name', 'books-management'),
            'singular_name'              => _x('Publisher', 'taxonomy singular name', 'books-management'),
            'search_items'               => __('Search Publishers', 'books-management'),
            'popular_items'              => __('Popular Publishers', 'books-management'),
            'all_items'                  => __('All Publishers', 'books-management'),
            'parent_item'                => null,
            'parent_item_colon'          => null,
            'edit_item'                  => __('Edit Publisher', 'books-management'),
            'update_item'                => __('Update Publisher', 'books-management'),
            'add_new_item'               => __('Add New Publisher', 'books-management'),
            'new_item_name'              => __('New Publisher Name', 'books-management'),
            'separate_items_with_commas' => __('Separate publishers with commas', 'books-management'),
            'add_or_remove_items'        => __('Add or remove publishers', 'books-management'),
            'choose_from_most_used'      => __('Choose from the most used publishers', 'books-management'),
            'menu_name'                  => __('Publishers', 'books-management'),
        ];

        $args = [
            'hierarchical'          => false,
            'labels'                => $labels,
            'show_ui'               => true,
            'show_admin_column'     => true,
            'update_count_callback' => '_update_post_term_count',
            'query_var'             => true,
            'rewrite'               => ['slug' => 'publisher'],
        ];

        register_taxonomy('publisher', 'book', $args);
    }
}