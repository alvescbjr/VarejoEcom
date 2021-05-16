<?php

namespace VarejoEcom\Settings\Plugin\Helper;

trait wp_varejoecom_flash_message_trait
{
    public function wp_varejoecom_define_message(string $type, string $message) : void
    {
        $_SESSION['message'] = $message;
        $_SESSION['type'] = $type;

    }
}