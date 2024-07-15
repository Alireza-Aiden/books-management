<?php

namespace BooksManagement\Admin;

class AdminPage
{
    public function register()
    {
        add_action('admin_menu', [$this, 'addMenuPage']);
    }

    public function addMenuPage()
    {
        add_menu_page(
            __('Books Info', 'books-management'),
            __('Books Info', 'books-management'),
            'manage_options',
            'books-info',
            [$this, 'renderPage'],
            'dashicons-book-alt',
            6
        );
    }

    public function renderPage()
    {
        if (!class_exists('WP_List_Table')) {
            require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
        }
        $table = new BooksInfoTable();
        $table->prepare_items();
        ?>
        <div class="wrap">
            <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
            <?php $table->display(); ?>
        </div>
        <?php
    }
}