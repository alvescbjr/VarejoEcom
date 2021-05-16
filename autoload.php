<?php

spl_autoload_register(function(string $className){
    $file_path = str_replace("VarejoEcom\\Settings\\Plugin", "/src", $className);
    $file_path = str_replace("\\", DIRECTORY_SEPARATOR, $file_path);
    $file_path .= '.php';

    if (file_exists(plugin_dir_path(__FILE__) . $file_path)) {
        require_once(plugin_dir_path(__FILE__) . $file_path);
    }
});