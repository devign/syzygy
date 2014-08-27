<?php
require_once 'config.php';
require_once 'functions.php';

spl_autoload_register(function ($class) {
    include 'classes/' . $class . '.php';
});

$date_time = new DateTime(null, new DateTimeZone($config['time_zone']));
$action = '';
$db = new Database();

//error_reporting(E_ALL);

if (isset($_GET['a'])) {

	$action = $_GET['a'];

} elseif (isset($_POST['a'])) {

	$action = $_POST['a'];

}




?>