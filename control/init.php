<?php
require_once 'config.php';

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

?>
