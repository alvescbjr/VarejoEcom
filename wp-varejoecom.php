<?php
/**
 * Plugin Name: WP VarejoEcom
 * Description: varejoecom customizations plugin
 * Version: 1.0.0
 * Author: Francisco de Assis
 * Text Domain: wp_varejoecom
 */
namespace VarejoEcom\Settings\Plugin;


if (!defined('ABSPATH') &&  is_plugin_active('wp-varejoecom/wp-varejoecom.php')) {
    exit();
}

require plugin_dir_path(__FILE__) . 'autoload.php';

use  VarejoEcom\Settings\Plugin\Settings\{wp_varejoecom_settings_shipping_company, wp_varejoecom_settings};

if (!class_exists('wp_varejoecom')) {

    class wp_varejoecom
    {
        public function __construct()
        {
            session_start();

            // Load plugin text domain
            add_action('init', array($this, 'load_plugin_textdomain'));

            // register_activation_hook(__FILE__, );
            $this->wp_varejoecom_create_settings_shipping_company();   
            $this->wp_varejoecom_register_scripts();
        }

        public static function instance() : self 
        {
            static $instance = null;
     
            if (is_null($instance)) {
                $instance = new wp_varejoecom();
            }
             
            return $instance;
        }

        public function wp_varejoecom_create_settings_shipping_company() : void
        {
            (new wp_varejoecom_settings_shipping_company())->wp_varejoecom_shipping_company_table();
        }

        public function wp_varejoecom_register_scripts() : void
        {
            (new wp_varejoecom_settings());
        }


        public static function load_plugin_textdomain($class_name) : void 
        {

            // Load plugin textdomain for translation
            load_plugin_textdomain('wp_varejoecom', false, dirname(plugin_basename(__FILE__)) . DIRECTORY_SEPARATOR . 'languages' . DIRECTORY_SEPARATOR);
        }
    }

    add_action('plugins_loaded', array(__NAMESPACE__ . '\wp_varejoecom', 'instance'), 0);
}
