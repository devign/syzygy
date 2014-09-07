<?php

require_once 'init.php';

if (user_logged_in() === false) {
    header("Location: login_form.php");
    exit;
}

$action = $route[0];

/**
* SET ROUTE ARRAY
*/
if (isset($route[1])) {
    $route[0] .= '_' . $route[1] . '.php';
} else {
    $route[0] .= '.php';
}

/**
* IF URL CONTAINS PARAMETERS, SET PARAMS ARRAY 
*/
if (isset($route[2])) {
    $params = explode('|', $route[2]);
}

/**
* IF ROUTE FILE DOES NOT EXIST, SET ROUTE TO ERROR PAGE
*/
if (!file_exists(dirname(__FILE__) . DSEP . $route[0])) {
    $route[0] = 'error.php';    
} 

include $header;

include $route[0];

include $footer;


?>
