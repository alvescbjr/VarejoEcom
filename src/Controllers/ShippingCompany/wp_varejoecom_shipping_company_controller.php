<?php

namespace VarejoEcom\Settings\Plugin\Controllers\ShippingCompany;

use VarejoEcom\Settings\Plugin\Controllers\wp_varejoecom_controls_html;
use VarejoEcom\Settings\Plugin\Entity\ShippingCompany\shipping_company_entity;
use VarejoEcom\Settings\Plugin\Helper\wp_varejoecom_flash_message_trait;

class wp_varejoecom_shipping_company_controller  extends wp_varejoecom_controls_html
{

    use wp_varejoecom_flash_message_trait;
    private object $shipping_company_entity;


    public function __construct()
    {
        $this->shipping_company_entity = new shipping_company_entity();
    }

    public function wp_varejoecom_main_page() : void
    {
        echo $this->renders_html(
            '/wp_varejoecom_main_page.php',
            [
                'titulo' => 'VarejoEcom'
            ]
        );
    }




    /**
     * =====================================================================================================
     * |                   Displaying the shipping company registration form                               |
     * =====================================================================================================
     */
    public function wp_varejoecom_register_shipping_company_form() : void
    {

        $id = (int) isset($_GET['id']) ? $_GET['id'] : 0;

        echo $this->renders_html(
            '/shipping_company/wp_varejoecom_register_shipping_company_form.php',
            [
                'data' => $this->shipping_company_entity->wp_varejoecom_get_specific_shipping_company($id),
                'titulo' => 'Register Shipping Company',
            ]
        );
    }




    /**
     * =====================================================================================================
     * |   get form submit data                                                                            |
     * =====================================================================================================
     */
    public function wp_varejoecom_register_shipping_company_form_submit() : void
    {

        if (sizeof($_POST) > 0) {
            $id             = (int) $_POST['id']; 

            $link = menu_page_url( 'cadastrar-transportadora', false);

            if ($id === 0 && !$this->wp_varejoecom_validate_shipping_company_register($_POST)) {
                $this->wp_varejoecom_define_message('danger', 'Please fill in the correct fields. Or make sure there is no registration!');
                wp_redirect($link);
                return;
            }

            $identifier     = (int) $_POST['wp_varejoecom_shipping_company_identifier'];
            $shipping_name  = $_POST['wp_varejoecom_shipping_company_name'];
            $cnpj           = $_POST['wp_varejoecom_shipping_company_cnpj'];
            $status         = $_POST['wp_varejoecom_shipping_company_status'];

            if ($id === 0) {
                //Saving
                $this->shipping_company_entity->wp_varejoecom_save_shipping_company($identifier, $shipping_name, $cnpj, $status);
                $this->wp_varejoecom_define_message('success', 'Registered successfully!');
                wp_redirect(menu_page_url('lista-transportadoras', false));
                return;
            }

            //Updating
            $this->shipping_company_entity->wp_varejoecom_update_shipping_company($id, $identifier, $shipping_name, $cnpj, $status);
            $this->wp_varejoecom_define_message('success', 'Updated successfully!');
            wp_redirect(menu_page_url('lista-transportadoras', false));
        }
    }




    /**
     * =====================================================================================================
     * |   validating the data                                                                             |
     * =====================================================================================================
     */
    public function wp_varejoecom_validate_shipping_company_register(array $post) : bool
    {
        $fields = array(
            'field_one'     => 'wp_varejoecom_shipping_company_identifier',
            'field_two'     => 'wp_varejoecom_shipping_company_name',
            'field_three'   => 'wp_varejoecom_shipping_company_cnpj',
            'field_for'     => 'wp_varejoecom_shipping_company_status'
        );

        foreach ($fields as $key => $field) {

            if (!array_key_exists($field, $post) || empty($post[$field])) {
                return false;
            }
        }

        if ($this->shipping_company_entity->shipping_company_is_exists(intval($post['wp_varejoecom_shipping_company_identifier']), $post['wp_varejoecom_shipping_company_name'], $post['wp_varejoecom_shipping_company_cnpj'])) {
            return false;
        }

        return true;
    }




    /**
     * =====================================================================================================
     * |                   Viewing the shipping company list                                               |
     * =====================================================================================================
     */
    public function wp_varejoecom_list_shipping_company() : void
    {
        echo $this->renders_html(
            '/shipping_company/wp_varejoecom_list_shipping_company.php',
            [
                'companies' => $this->shipping_company_entity->wp_varejoecom_get_all_shipping_company(),
                'titulo' => 'Shipping Company List',
            ]
        ); 
    }
}