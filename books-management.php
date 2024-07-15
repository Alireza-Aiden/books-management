<?php
/**
 * Plugin Name: Books Management
 * Plugin URI:  https://yourwebsite.com
 * Description: A plugin for managing books in WordPress
 * Version:     1.0.0
 * Author:      Ali
 * Author URI:  https://yourwebsite.com
 * Text Domain: books-management
 * Domain Path: /languages
 */

// Ensure this file is being run within WordPress
/**if (!defined('ABSPATH')) {
    exit;
}

// Autoloader
$autoloader = dirname(__FILE__) . '/vendor/autoload.php';
if (file_exists($autoloader)) {
    require_once $autoloader;
} else {
    // If the autoloader doesn't exist, display an admin notice
    add_action('admin_notices', function() {
        echo '<div class="error"><p>Books Management plugin error: Composer autoloader not found. Please run composer install in the plugin directory.</p></div>';
    });
    return;
}

// Check if the Rabbit\Application class exists
if (!class_exists('Rabbit\Application')) {
    add_action('admin_notices', function() {
        echo '<div class="error"><p>Books Management plugin error: Rabbit\Application class not found. Please ensure the Rabbit framework is installed correctly.</p></div>';
    });
    return;
}

use Rabbit\Application;
use BooksManagement\BooksManagementPlugin;

// Initialize the plugin
function books_management_init() {
    try {
        $app = Application::getInstance();
        $app->bind('plugin', new BooksManagementPlugin($app));
        $app->boot();
    } catch (Exception $e) {
        add_action('admin_notices', function() use ($e) {
            echo '<div class="error"><p>Books Management plugin error: ' . esc_html($e->getMessage()) . '</p></div>';
        });
    }
}

books_management_init();
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