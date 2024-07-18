<?php

namespace BooksManagement;

use Rabbit\Application;
use BooksManagement\PostType\BookPostType;
use BooksManagement\Taxonomies\AuthorTaxonomy;
use BooksManagement\Taxonomies\PublisherTaxonomy;
use BooksManagement\Admin\AdminPage;
use BooksManagement\Database\BooksTable;

class BooksManagementPlugin extends Application {
    private $plugin_dir;
    private $plugin_file;
    private $app;

    public function __construct($plugin_dir, $plugin_file) {
        $this->plugin_dir = $plugin_dir;
        $this->plugin_file = $plugin_file;
        $this->app = new Application();
    }

    public function init() {
        // Register custom post type Book
        BookPostType::register();

        // Register taxonomies
        AuthorTaxonomy::register();
        PublisherTaxonomy::register();

        // Add Meta Box for ISBN in Book post type
        add_action('add_meta_boxes', [$this, 'add_isbn_meta_box']);
        add_action('save_post', [$this, 'save_isbn_meta_box']);

        // Register admin page
        AdminPage::register();
    }

    public static function activate() {
        // Create books_info table
        BooksTable::createTable();

        // Flush rewrite rules on activation
        flush_rewrite_rules();
    }

    public static function deactivate() {
        // Deactivation logic here
    }

    public function add_isbn_meta_box() {
        add_meta_box(
            'isbn_meta_box',
            __('ISBN Number', 'books-management'),
            [$this, 'render_isbn_meta_box'],
            'book',
            'normal',
            'default'
        );
    }

    public function render_isbn_meta_box($post) {
        // Retrieve current ISBN
        $isbn = get_post_meta($post->ID, '_isbn', true);

        // Output meta box HTML
        ?>
        <label for="isbn"><?php _e('ISBN:', 'books-management'); ?></label>
        <input type="text" id="isbn" name="isbn" value="<?php echo esc_attr($isbn); ?>" />
        <?php
    }

    public function save_isbn_meta_box($post_id) {
        // Verify nonce
        if (!isset($_POST['isbn_meta_box_nonce']) || !wp_verify_nonce($_POST['isbn_meta_box_nonce'], 'isbn_meta_box_nonce')) {
            return;
        }

        // Check if this is an autosave
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        // Check the user's permissions
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }

        // Save ISBN number
        if (isset($_POST['isbn'])) {
            update_post_meta($post_id, '_isbn', sanitize_text_field($_POST['isbn']));
        }
    }
}
