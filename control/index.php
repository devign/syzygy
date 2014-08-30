<?php
require_once 'init.php';


include $header;

if (!file_exists(dirname(__FILE__) . DSEP . $action . '.php')) {
    $action = 'error.php';    
} else {
    $action .= '.php';
}

include $action;

include $footer;


?>
