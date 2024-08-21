<?php

namespace Inc\Admin;

class Admin {

    private $productPage;
    private $pospage;

    public function __construct() {
        $this->productPage = new ProductPage();
        $this->posPage = new PosPage();
    }

    public function hooks() {

        // error_log('Admin.php hook Function !!!');

        add_action('admin_menu', array($this, 'addAdminMenu'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_scripts'));

        // hooks

        add_action('admin_post_register_product', array('Inc\Admin\ProductHandler', 'register_product'));
        add_action('admin_post_delete_product', array('Inc\Admin\ProductHandler', 'delete_product'));
        add_action('admin_post_update_product', array('Inc\Admin\ProductHandler', 'update_product'));
        


    }

    public function addAdminMenu() {
        add_menu_page('Clothing Shop POS', 'POS Settings', 'manage_options', 'clothing-shop-pos', array($this, 'displaySettingsPage'));
        add_menu_page('Product Management', 'Products', 'manage_options', 'product-management', array($this->productPage, 'display'));

        add_submenu_page(
            'clothing-shop-pos',        // The slug of the parent page
            'My Custom Submenu',        // The title of the submenu page
            'Submenu',                  // The menu title
            'manage_options',           // The capability required for this menu to be displayed to the user
            'my-custom-submenu-slug',   // The slug by which this submenu will be identified
            array($this->posPage, 'display') // The function to call to display the submenu page content
        );

    }

    public function displaySettingsPage() {
        echo '<div class="wrap"><h1>Clothing Shop POS Settings</h1></div>';
    }

    public function enqueue_admin_scripts() {
        wp_enqueue_script('csp-admin-script', CLOTHING_SHOP_POS_PLUGIN_URL . 'assets/admin/js/admin.js', array('jquery'), '1.0', true);
    
        wp_enqueue_style('admin-product-css', CLOTHING_SHOP_POS_PLUGIN_URL . 'assets/admin/css/product-regi.css');

        wp_enqueue_script('pos-js', CLOTHING_SHOP_POS_PLUGIN_URL . 'assets/admin/js/pos.js', array('jquery'), '1.0.0', true);
        wp_localize_script('pos-js', 'ajax_object', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('search_product_nonce')
        ));

    }

    public function my_custom_submenu_page_callback() {
        echo '<div class="wrap">';
        echo '<h1>My Custom Submenu Page</h1>';
        echo '<p>Welcome to your new sub-admin page.</p>';
        echo '</div>';
    }

    
}