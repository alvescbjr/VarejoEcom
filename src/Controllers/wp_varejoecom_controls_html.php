<?php

namespace VarejoEcom\Settings\Plugin\Controllers\ShippingCompany\Settings\Plugin\Controllers;

class wp_varejoecom_controls_html
{
    public function renders_html(string $path_template, array $data) : string
    {
        extract($data);
        ob_start();

        require __DIR__ . '/../../view/' . $path_template;

        $html = ob_get_clean();
        return $html;
    }
}