<?php

namespace BooksManagement;

use Rabbit\Plugin;
use BooksManagement\PostTypes\BookPostType;
use BooksManagement\Taxonomies\PublisherTaxonomy;
use BooksManagement\Taxonomies\AuthorTaxonomy;
use BooksManagement\Admin\AdminPage;
use BooksManagement\Database\BooksTable;

class BooksManagementPlugin extends Plugin
{
    public function boot()
    {
        $this->registerHooks();
        $this->registerPostTypes();
        $this->registerTaxonomies();
        $this->setupDatabase();
        $this->setupAdminPage();
    }

    private function registerHooks()
    {
        add_action('plugins_loaded', [$this, 'loadTextdomain']);
    }

    public function loadTextdomain()
    {
        load_plugin_textdomain('books-management', false, dirname(plugin_basename(__FILE__)) . '/languages/');
    }

    private function registerPostTypes()
    {
        $bookPostType = new BookPostType();
        $bookPostType->register();
    }

    private function registerTaxonomies()
    {
        $publisherTaxonomy = new PublisherTaxonomy();
        $publisherTaxonomy->register();

        $authorTaxonomy = new AuthorTaxonomy();
        $authorTaxonomy->register();
    }

    private function setupDatabase()
    {
        $booksTable = new BooksTable();
        $booksTable->createTable();
    }

    private function setupAdminPage()
    {
        $adminPage = new AdminPage();
        $adminPage->register();
    }
}