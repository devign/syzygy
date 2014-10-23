<?php
/* SET ERROR REPORTING LEVEL **/
error_reporting(E_ALL);

require 'config.php';
require 'functions.php';

spl_autoload_register(function ($class) {
    include 'classes/' . $class . '.php';

});

/* INTIALIZE DATABASE **/
$db = new Database();


session_start();

$route = array();
$params = array();
$errors = array();
$template_data = array();

/***
* GET URL FOR ROUTE
*/
if (isset($_GET['a'])) {
    
    $route = getRoute($_GET['a']);

} else {
    
    $id = isPage('home');
    $route[] = 'page.php';
    $route[] = $id;

}



//var_dump(get_class_methods('Database'));

?>
