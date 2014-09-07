<?php
require_once('init.php');
  
?>

<html>
<head>
<title>SYZYGY LOGIN</title>
</head>
<body>
<div id="pageContainer">
    <div id="loginContainer">
        <div id="loginBox">
            <div id="logo"><img src="themes/default/images/storefront-logo-default.png" border="0" width="67" height="30" /></div>
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
                <input type="hidden" name="store_id" value="0">
                <div class="inputLabel">USERNAME:</div>
                <input autocomplete="off" type="text" name="username" value="" size="25">
                
                <br/>
                <br/>
                <div class="inputLabel">PASSWORD:</div>
                <input autocomplete="off" type="password" name="password" value="" size="25">
                <br/><br/>
                <input type="submit" value="Log In">
                </form>
            </div>
        </div>
    </div>

</div>

</body>
</html>