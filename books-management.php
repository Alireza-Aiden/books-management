<?php
/**
 * Plugin Name: Books Management
 * Description: A plugin for managing books in WordPress
 * Version:     1.0.0
 * Author:      Alireza Abedi   
 * Author URI:  https://aidenweb.ir
 * Text Domain: books-management
 * Domain Path: /languages
 */
 
require __DIR__ . '/vendor/autoload.php';

use BooksManagement\BooksManagementPlugin;
function books_management_init() {
    $plugin = new BooksManagementPlugin(__DIR__, __FILE__);
    $plugin->init();
}

register_activation_hook(__FILE__, ['BooksManagement\BooksManagementPlugin', 'activate']);
register_deactivation_hook(__FILE__, ['BooksManagement\BooksManagementPlugin', 'deactivate']);
add_action('plugins_loaded', 'books_management_init');