<?php
require_once 'init.php';


include $header;

include $menu;

include $action . '.php';

$data = $db->getData('SELECT 1 + 3 AS thisShit');

?>

<div><?php echo 'SHIT STORE: ' . $data->thisShit ?></div>

<?php 

include $footer;


?>
