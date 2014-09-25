<?php
require_once('init.php');
  
?>

<html>
<head>
<title>SYZYGY LOGIN</title>

<link href="/control/themes/<?= $config['theme'] . DSEP . $config['stylesheet_directory'] ?>styles.css" rel="stylesheet">
<link href="/control/themes/<?= $config['theme'] . DSEP . $config['stylesheet_directory'] ?>custom.css" rel="stylesheet">

</head>
<body>
<div class="container" id="pageContainer">
    <div class="col-sm-3 col-md-4 col-md-offset-4 mt90" id="loginContainer">
        <div id="logo"><img src="themes/default/images/storefront-logo-default.png" border="0" width="67" height="30" /></div>
        <div id="loginBox">
            <?php if (count($errors) > 0) :?>
                <div class="errorMessage">
                     <?php foreach ($errors as $error) : ?>
                     <?= $error ?>
                     <?php endforeach; ?>
                 </div>
             <?php else :?>
                <div class="instruct"><?= $config['login_instructions']?></div>
             <?php endif?>
             <div id="loginArea">
                <form name="formLogin" method="post" action="login.php">
                <input type="hidden" name="store_id" value="3">
                <div class="inputLabel">Username:</div>
                <input class="login-form-input" autocomplete="off" type="text" name="username" value="">
                <div class="inputLabel">Password:</div>
                <input class="login-form-input" autocomplete="off" type="password" name="password" value="">
                <input class="login-button" type="submit" value="Log In">
                </form>
            </div>
        </div>
    </div>

</div>

</body>
</html>