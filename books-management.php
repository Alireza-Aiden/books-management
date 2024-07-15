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
if (!defined('ABSPATH')) {
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

use Rabbit\Application;

// Initialize the plugin
function books_management_init() {
    try {
        $app = Application::getInstance();
        $plugin = $app->loadPlugin(
            __DIR__,
            __FILE__,
            __DIR__ . '/config'
        );
        
        // Register your plugin's hooks, filters, etc. here
        // For example:
        add_action('init', [$plugin, 'init']);
        
    } catch (Exception $e) {
        add_action('admin_notices', function() use ($e) {
            echo '<div class="error"><p>Books Management plugin error: ' . esc_html($e->getMessage()) . '</p></div>';
        });
    }
}

// Hook for plugin activation
register_activation_hook(__FILE__, 'books_management_activate');

function books_management_activate() {
    // Activation code here (e.g., create database tables)
}

// Hook for plugin deactivation
register_deactivation_hook(__FILE__, 'books_management_deactivate');

function books_management_deactivate() {
    // Deactivation code here
}

// Load text domain for internationalization
add_action('plugins_loaded', 'books_management_load_textdomain');

function books_management_load_textdomain() {
    load_plugin_textdomain('books-management', false, dirname(plugin_basename(__FILE__)) . '/languages/');
}

// Initialize the plugin
books_management_init();