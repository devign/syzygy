<?php
/* SET ERROR REPORTING LEVEL **/
error_reporting(E_ALL);

require 'config.php';
require 'frontend/functions.php';

spl_autoload_register(function ($class) {
    include 'frontend/classes/' . $class . '.php';

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
    
    if (file_exists(THEME_PATH . 'home.phtml')) {
        $route[] = 'themes/' . $config['theme'] . DSEP . 'home.phtml';
    } else {
        $id = isPage('home');
        $route[] = 'page.php';
        $route[] = $id;
    }
}



//var_dump(get_class_methods('Database'));

?>
