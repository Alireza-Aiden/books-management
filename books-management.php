<?php
/**
 * Plugin Name: Books Management
 * Plugin URI:  https://yourwebsite.com
 * Description: A plugin for managing books in WordPress
 * Version:     1.0.0
 * Author:      Ali
 * Author:      Ali
 * Author URI:  https://yourwebsite.com
 * Text Domain: books-management
 * Domain Path: /languages
 */
 

// if (!defined('ABSPATH')) {
//     exit;
// }
require __DIR__ . '/vendor/autoload.php';

// // Autoload Rabbit and Composer dependencies
// if (file_exists(__DIR__ . '/vendor/autoload.php')) {
//     require_once __DIR__ . '/vendor/autoload.php';
// }
use BooksManagement\BooksManagementPlugin;
function books_management_init() {
    $plugin = new BooksManagementPlugin(__DIR__, __FILE__);
    $plugin->init();
}

register_activation_hook(__FILE__, ['BooksManagement\BooksManagementPlugin', 'activate']);
register_deactivation_hook(__FILE__, ['BooksManagement\BooksManagementPlugin', 'deactivate']);
add_action('plugins_loaded', 'books_management_init');