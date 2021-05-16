<?php

function wp_varejoecom_destroys_messaging_session()
{
    unset($_SESSION['message']);
    unset($_SESSION['type']);
}

return wp_varejoecom_destroys_messaging_session();