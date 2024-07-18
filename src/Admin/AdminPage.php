<?php

namespace BooksManagement\Admin;

class AdminPage {
    public static function register() {
        add_action('admin_menu', [__CLASS__, 'add_books_management_page']);
    }

    public static function add_books_management_page() {
        add_menu_page(
            __('Books Management', 'books-management'),
            __('Books Management', 'books-management'),
            'manage_options',
            'books-management',
            [__CLASS__, 'render_books_management_page'],
            'dashicons-book-alt',
            20
        );
    }

    public static function render_books_management_page() {
        echo '<div class="wrap"><h2>Books Management</h2><p>Here you can manage your books.</p></div>';
    }
}
