<?php

namespace BooksManagement\PostTypes;

class BookPostType
{
    public function register()
    {
        add_action('init', [$this, 'registerPostType']);
        add_action('add_meta_boxes', [$this, 'addMetaBox']);
        add_action('save_post', [$this, 'saveMetaBox']);
    }

    public function registerPostType()
    {
        $labels = [
            'name'               => _x('Books', 'post type general name', 'books-management'),
            'singular_name'      => _x('Book', 'post type singular name', 'books-management'),
            'menu_name'          => _x('Books', 'admin menu', 'books-management'),
            'name_admin_bar'     => _x('Book', 'add new on admin bar', 'books-management'),
            'add_new'            => _x('Add New', 'book', 'books-management'),
            'add_new_item'       => __('Add New Book', 'books-management'),
            'new_item'           => __('New Book', 'books-management'),
            'edit_item'          => __('Edit Book', 'books-management'),
            'view_item'          => __('View Book', 'books-management'),
            'all_items'          => __('All Books', 'books-management'),
            'search_items'       => __('Search Books', 'books-management'),
            'parent_item_colon'  => __('Parent Books:', 'books-management'),
            'not_found'          => __('No books found.', 'books-management'),
            'not_found_in_trash' => __('No books found in Trash.', 'books-management')
        ];

        $args = [
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => ['slug' => 'book'],
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'supports'           => ['title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments']
        ];

        register_post_type('book', $args);
    }

    public function addMetaBox()
    {
        add_meta_box(
            'book_isbn',
            __('ISBN', 'books-management'),
            [$this, 'renderMetaBox'],
            'book',
            'side',
            'default'
        );
    }

    public function renderMetaBox($post)
    {
        wp_nonce_field('book_isbn_nonce', 'book_isbn_nonce');
        $value = get_post_meta($post->ID, '_book_isbn', true);
        echo '<label for="book_isbn">' . __('ISBN:', 'books-management') . '</label> ';
        echo '<input type="text" id="book_isbn" name="book_isbn" value="' . esc_attr($value) . '" size="25" />';
    }

    public function saveMetaBox($post_id)
    {
        if (!isset($_POST['book_isbn_nonce'])) {
            return;
        }

        if (!wp_verify_nonce($_POST['book_isbn_nonce'], 'book_isbn_nonce')) {
            return;
        }

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        if (!current_user_can('edit_post', $post_id)) {
            return;
        }

        if (!isset($_POST['book_isbn'])) {
            return;
        }

        $isbn = sanitize_text_field($_POST['book_isbn']);
        update_post_meta($post_id, '_book_isbn', $isbn);

        global $wpdb;
        $table_name = $wpdb->prefix . 'books_info';

        $wpdb->replace(
            $table_name,
            [
                'post_id' => $post_id,
                'isbn'    => $isbn
            ],
            ['%d', '%s']
        );
    }
}