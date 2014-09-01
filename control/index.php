<?php
require_once 'init.php';
$action = $route[0];

include $header;

if (isset($route[1])) {
    $route[0] .= '_' . $route[1] . '.php';
} else {
    $route[0] .= '.php';
}

if (!file_exists(dirname(__FILE__) . DSEP . $route[0])) {
    $route[0] = 'error.php';    
} 


include $route[0];

include $footer;


?>
