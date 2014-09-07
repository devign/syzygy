<?php

session_destroy();

setcookie('SYZYGY_STOREID', '', time() - 3600);
setcookie('SYZYGY_USERID', '', time() - 3600);

header("Location: login_form.php");

?>


