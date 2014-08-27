<?php
require_once 'init.php'; 

setcookie('HWO_STOREID', '', time() - 3600);
setcookie('HWO_ASSOCID', '', time() - 3600);

header("Location: login.php");

?>


