<?php
require_once 'config.php';
require_once 'functions.php';
session_start();
error_reporting(E_ALL);

$route = array();
$params = array();
$errors = array();

/***
* GET URL FOR ROUTE
*/
if (isset($_GET['a'])) {
 //   $action = preg_replace('/\W/', '', $action);
    $url = rtrim($_GET['a'], '/');
    $route = explode('/', $url);
    
} else {
    $route[0] = 'dashboard';
}

spl_autoload_register(function ($class) {
    include '../classes/' . $class . '.php';
});


$db = new Database();

//var_dump(get_class_methods('Database'));

?>
