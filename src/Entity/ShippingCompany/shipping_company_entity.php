<?php

namespace VarejoEcom\Settings\Plugin\Entity\ShippingCompany;

class shipping_company_entity
{
    private string $table_name = 'shipping_company';

    /**
     * =====================================================================================================
     * |   saving shipping company                                                                         |
     * =====================================================================================================
     */
    public function wp_varejoecom_save_shipping_company(int $identifier, string $shipping_company_name, string $cnpj, string $status) : void
    {
        global $wpdb;

        $tableName = $wpdb->prefix . $this->table_name;
        $wpdb->insert(
            $tableName,
            array(
                'identifier'    => $identifier,
                'name'          => $shipping_company_name,
                'cnpj'          => $cnpj,
                'status'        => $status
            )
        );
    }




    /**
     * =====================================================================================================
     * |   updating shipping company                                                                         |
     * =====================================================================================================
     */

    public function wp_varejoecom_update_shipping_company(int $id, int $identifier, string $shipping_company_name, string $cnpj, string $status) : void
    {
        global $wpdb;

        $tableName = $wpdb->prefix . $this->table_name;
        $data = [
            'identifier'    => $identifier,
            'name'          => $shipping_company_name,
            'cnpj'          => $cnpj,
            'status'        => $status
        ];
        $where = ['id' => $id];

        $wpdb->update($tableName, $data, $where);
    }




    /**
     * =====================================================================================================
     * |    validate if data already exists                                                                |
     * =====================================================================================================
     */
    public function shipping_company_is_exists(int $identifier, string $shipping_company_name, string $cnpj) : bool
    {
        global $wpdb;

        $tableName = $wpdb->prefix . $this->table_name;

        $result =  $wpdb->get_results("SELECT * FROM  {$tableName} 
                                        WHERE identifier = {$identifier} 
                                        OR name = '{$shipping_company_name}'
                                        AND cnpj = '{$cnpj}'
                                    ", ARRAY_A);
        
        return sizeof($result[0]) > 0 ? true : false;
    }




    /**
     * =====================================================================================================
     * |    get all shipping company                                                             |
     * =====================================================================================================
     */
    public function wp_varejoecom_get_all_shipping_company() : ?array
    {
        global $wpdb;
        $tableName = $wpdb->prefix . $this->table_name;

        $result =  $wpdb->get_results("SELECT * FROM  {$tableName}", ARRAY_A);

        return sizeof($result) > 0 ? $result : null;
    }




    /**
     * =====================================================================================================
     * |    get specific shipping company                                                                  |
     * =====================================================================================================
     */
    public function wp_varejoecom_get_specific_shipping_company(int $identifier) : array
    {
        global $wpdb;
        $tableName = $wpdb->prefix . $this->table_name;

        $result = $wpdb->get_results("SELECT * FROM {$tableName} WHERE identifier = {$identifier}", ARRAY_A);

        if (sizeof($result) <= 0 ) {
            $result = [
                0 => [
                    'id'            => 0,
                    'identifier'    => '',
                    'name'          => '',
                    'cnpj'          => '',
                    'status'        => ''
                ]
            ];
        }
        
        return $result[0];
    }
}