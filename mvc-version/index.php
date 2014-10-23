<?php

define('SITE_PATH', realpath(dirname(__FILE__)));

// TODO: use an autoloader
require SITE_PATH . '/libs/Controller.php';
require SITE_PATH . '/libs/View.php';

if ($_GET['a']) {
    $route = new Router($_GET['a']);
}


?>
