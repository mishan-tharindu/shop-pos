<?php

namespace Inc\Core;

// Import the Admin class from the Inc\Admin namespace
use Inc\Admin\Admin;
use Inc\PublicArea\PublicArea;
use Inc\Admin\ProductHandler;


class Init {

    private $installDatabaseHanlder;

    public function __construct() {
        
    }

    // public function register_hook() {
    //     add_action('plugins_loaded', [$this, 'init']);
    // }

    public function init() {
        // Initialize other core components
        $this->loadDependencies();
        $this->defineAdminHooks();
        $this->definePublicHooks();
        $this->defineProductHandlerHooks();
        // $this->installDatabaseHandlerHooks();
    }


    private function loadDependencies() {
        // Autoloaded via Composer
    }

    private function defineAdminHooks() {
        $admin = new Admin();
        $admin->hooks();
    }

    private function definePublicHooks() {
        $public = new PublicArea();
        $public->hooks();
    }

    private function defineProductHandlerHooks(){
        // error_log('defineProductHandlerHooks Called !!!');
        $productHandler = new ProductHandler();
        $productHandler->register_hooks();
    }

    // private function installDatabaseHandlerHooks(){
    //     $installDatabaseHanlder = new DatabaseInstall();
    //     $installDatabaseHanlder -> database_install();
    // }

}