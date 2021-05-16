<?php

namespace VarejoEcom\Settings\Plugin\Settings;

class wp_varejoecom_settings_shipping_company
{
    private string $table_name = 'shipping_company';

    /**
    * =====================================================================================================
    * |            Creating table in the database : shipping_company                                      |
    * |___________________________________________________________________________________________________|
    * =====================================================================================================
    */
    public function wp_varejoecom_shipping_company_table() : void
    {
        global $wpdb;
        require_once(ABSPATH. 'wp-admin/includes/upgrade.php');

        $tableName = $wpdb->prefix . $this->table_name;
        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE $tableName(
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    identifier INT NOT NULL,
                    name VARCHAR(255) NOT NULL,
                    cnpj VARCHAR(20) NOT NULL,
                    status VARCHAR(100) NOT NULL
                )$charset_collate;
        ";
        maybe_create_table($tableName, $sql);
    }

}