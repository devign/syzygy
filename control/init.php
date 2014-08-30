<?php
require_once 'config.php';
error_reporting(E_ALL);
$header = 'themes' . DSEP . $config['theme'] . DSEP . 'header.php';
$footer = 'themes' . DSEP . $config['theme'] . DSEP . 'footer.php';
$menu = 'themes' . DSEP . $config['theme'] . DSEP . 'menu.php';


if (isset($_GET['a'])) {
    $action = trim($_GET['a'], '/');
}

spl_autoload_register(function ($class) {
    include 'classes/' . $class . '.php';
});


$db = new Database();

//var_dump(get_class_methods('Database'));

?>
