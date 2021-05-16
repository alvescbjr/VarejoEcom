<?php

namespace VarejoEcom\Settings\Plugin\Settings;

use VarejoEcom\Settings\Plugin\Controllers\ShippingCompany\wp_varejoecom_shipping_company_controller;

class wp_varejoecom_settings
{

    private object $shipping_company_controller;

    public function __construct()
    {

        $this->shipping_company_controller = new wp_varejoecom_shipping_company_controller();

        //register scripts
        add_action('admin_enqueue_scripts', array($this,'wp_varejoecom_register_style_sheets'));
        add_action('admin_enqueue_scripts', array($this, 'wp_varejoecom_register_scripts'));
        //menus
        add_action('admin_menu', array($this,'wp_varejoecom_menu_settings'));
        add_action('admin_menu', array($this, 'wp_varejoecom_submenu_shipping_company'));
    }

    /**
    * =====================================================================================================
    * |                           Registering the Style                                                   |
    * |___________________________________________________________________________________________________|
    * | Style sheets                                                                                      |
    * =====================================================================================================
    */
    public function wp_varejoecom_register_style_sheets() : void
    {
        wp_register_style('wp_varejoecom-style', plugins_url() . '/wp_varejoecom/dist/css/style.css');
        wp_enqueue_style( 'wp_varejoecom-style' );

        wp_register_style('wp_varejoecom-style-bootstrap', plugins_url() . '/wp_varejoecom/dist/css/framework/bootstrap/css/bootstrap.min.css');
        wp_enqueue_style( 'wp_varejoecom-style-bootstrap' );
    }


    /**
     * =====================================================================================================
     * |                           Registering the scripts                                                 |
     * |___________________________________________________________________________________________________|
     * | Scripts JS                                                                                        |
     * =====================================================================================================
     */
    public function wp_varejoecom_register_scripts() : void
    {
        wp_register_script(
            'wp_varejoecom_javascript_bootstrap', 
            plugins_url() . '/wp_varejoecom/dist/css/framework/bootstrap/js/bootstrap.min.js',
            array('jquery'),
            false,
            true
        );
    }


    /**
     * =====================================================================================================
     * |                                    MENU VarejoEcom                                                  |
     * =====================================================================================================
     */
    public function wp_varejoecom_menu_settings() : void
    {
        $page_title = 'VarejoEcom';
        $menu_title = 'VarejoEcom';
        $capability = 'manage_options';
        $menu_slug = 'VarejoEcom-settings';
        $function = array($this->shipping_company_controller, 'wp_varejoecom_main_page');
        $icon_url = 'dashicons-admin-tools';
        $position = -1;
    
        add_menu_page(
            $page_title,
            $menu_title,
            $capability,
            $menu_slug,
            $function,
            $icon_url,
            $position
        );
    }


    /**
     * =====================================================================================================
     * |                                    SubMENUs VarejoEcom                                              |
     * =====================================================================================================
     */
    public function wp_varejoecom_submenu_shipping_company() : void
    {
        $parent_slug = 'VarejoEcom-settings';
        $page_title = __('Register Shipping Company', 'wp_varejoecom');
        $menu_title = __('Register Shipping Company', 'wp_varejoecom');
        $capability = 'manage_options';
        $menu_slug = 'cadastrar-transportadora';
        $function = array($this->shipping_company_controller, 'wp_varejoecom_register_shipping_company_form');
        $position = null ;

        $hookname = add_submenu_page(
            $parent_slug ,
            $page_title , 
            $menu_title,
            $capability,
            $menu_slug,
            $function,
            $position
        );

        $this->wp_varejoecom_submenu_list_shipping_company();

        add_action( 'load-' . $hookname, array($this->shipping_company_controller, 'wp_varejoecom_register_shipping_company_form_submit'));
    }

    public function wp_varejoecom_submenu_list_shipping_company() : void
    {
        $parent_slug = 'VarejoEcom-settings';
        $page_title = __('List Shipping Company', 'wp_varejoecom');
        $menu_title = __('List Shipping Company', 'wp_varejoecom');
        $capability = 'manage_options';
        $menu_slug = 'lista-transportadoras';
        $function = array($this->shipping_company_controller, 'wp_varejoecom_list_shipping_company');
        $position = null ;

        add_submenu_page(
            $parent_slug ,
            $page_title , 
            $menu_title,
            $capability,
            $menu_slug,
            $function,
            $position
        );
    }

}