<?php
require_once 'init.php';


include $header;

if (!file_exists($config['admin_directory'] . $action . '.php')) {
    $action = 'error.php';    
} else {
    $action .= '.php';
}

include $action;

include $footer;


?>
