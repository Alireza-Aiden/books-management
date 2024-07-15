<?php
/**
 * Plugin Name: Books Management
 * Plugin URI:  https://yourwebsite.com
 * Description: A plugin for managing books in WordPress
 * Version:     1.0.0
 * Author:      Your Name
 * Author URI:  https://yourwebsite.com
 * Text Domain: books-management
 * Domain Path: /languages
 */

use Rabbit\Application;
use BooksManagement\BooksManagementPlugin;

// Ensure this file is being run within WordPress
if (!defined('ABSPATH')) {
    exit;
}

// Autoloader
if (file_exists(dirname(__FILE__) . '/vendor/autoload.php')) {
    require_once dirname(__FILE__) . '/vendor/autoload.php';
}

// Initialize the plugin
function books_management_init() {
    $app = Application::getInstance();
    $app->bind('plugin', new BooksManagementPlugin($app));
    $app->boot();
}

books_management_init();