<?php
/**
* GET STORES  
*/
$allStores = array();

if (array_key_exists('SYZYGY_STOREID', $_COOKIE)) {
    $result = $db->query("SELECT domain FROM stores WHERE store_id = " . $_COOKIE['SYZYGY_STOREID']);
    $tmpStore = $result->fetch_object();
    array_push($allStores, $tmpStore->domain);
}

$result = $db->query("SELECT domain FROM stores ORDER BY domain");

while ($tmpStore = $result->fetch_object()) {
    if (!in_array($tmpStore->domain, $allStores)) {
        array_push($allStores, $tmpStore->domain);
    }
}

/**
* GET SALES DATA
*/


/** GET LOGGED IN USER DATA
* 
*/
if (array_key_exists('SYZYGY_USERID', $_COOKIE)) {
$result = $db->query("SELECT first_name, last_name, avatar FROM users WHERE user_id = $_COOKIE[SYZYGY_USERID]");
$user = $result->fetch_object();
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Syzygy - We sell shit for real low cheap.</title>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
 
    <!-- Include all compiled plugins (below), or include individual files as needed -->

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    
    <link href='//fonts.googleapis.com/css?family=PT+Sans|PT+Sans+Narrow' rel='stylesheet' type='text/css'>
    
    <!-- Bootstrap -->
    <link href="/control/themes/<?= $config['theme'] . DSEP . $config['stylesheet_directory'] ?>styles.css" rel="stylesheet">
    <link href="/control/themes/<?= $config['theme'] . DSEP . $config['stylesheet_directory'] ?>custom.css" rel="stylesheet">
    
    <script src="/control/js/functions.js"></script>
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="dashboard">
  

      <header class="container mt30">

        <div class="row">
        
          <div class="col-xs-2 col-md-1 col-lg-1 logo">

            <a title="Powered by Syzygy." href="/" class="hidden-xs hidden-sm hidden-md"><img title="Powered by Syzygy." src="/control/images/storefront-logo-default.png" alt="Powered by Sysygy" /></a>

            <a title="Powered by Syzygy." href="/" class="hidden-lg"><img title="Powered by Syzygy." src="/control/images/storefront-mobile-logo-default.png" alt="Powered by Sysygy" /></a>

          </div><!-- /.col-xs-4 /.col-md-2 /.col-lg-1 logo -->

          <div class="col-md-3 domain-control hidden-xs hidden-sm">

            <div class="dropdown">
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
                <?= $allStores[0] ?>
                <span class="caret"></span>
              </button>

              <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
            <?php foreach ($allStores as $storeName) : ?>              
                <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><?= $storeName?></a></li>
            <?php endforeach; ?>
                <li role="presentation" class="divider"></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><span class="glyphicon glyphicon-plus-sign"></span> Add Site</a></li>
              </ul>
            </div><!-- /.dropdown -->

          </div><!-- /.col-lg-3 -->

          <div class="col-xs-10 col-md-3 user-control pull-right">

            <ul>
              <li><img title="<?= $user->first_name; $user->last_name?>" src="images/users/<?=$user->avatar?>" alt="<?=$user->first_name; $user->last_name?>" /></li>
              <li>
                  <div class="dropdown hidden-xs hidden-sm hidden-md">
                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown">
                      <?= $user->first_name ?>
                      <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu2">
                      <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Settings</a></li>
                      <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Messages</a></li>
                      <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Activity Log</a></li>
                      <li role="presentation" class="divider"></li>
                      <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Documentation</a></li>
                      <li role="presentation" class="divider"></li>                   
                      <li role="presentation"><a role="menuitem" tabindex="-1" href="/control/logout.php"> Log Out</a></li>                      
                      <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><span class="glyphicon glyphicon-user"></span> Change User</a></li>
                    </ul>
                  </div><!-- /.dropdown -->

                  <div class="dropdown hidden-lg">
                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu3" data-toggle="dropdown">
                      <i class="fa fa-bars"></i> <?= $user->first_name ?>
                      <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu3">
                      <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Settings</a></li>
                      <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Messages</a></li>
                      <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Activity Log</a></li>
                      <li role="presentation" class="divider"></li>
                      <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Documentation</a></li>
                      <li role="presentation" class="divider"></li>
                      <li role="presentation"><a role="menuitem" tabindex="-1" href="/control/logout"> Log Out</a></li>
                      <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><span class="glyphicon glyphicon-user"></span> Change User</a></li>
                    </ul>
                  </div><!-- /.dropdown -->

              </li>
              <li class="float-right user-icon"><a href=""><span class="glyphicon glyphicon-cog"></span></a></li>
              <li class="float-right user-icon user-mail-icon"><a href=""><span class="glyphicon glyphicon-envelope"></span><div class="mail-notification"></div></a></li>
            </ul>

          </div><!-- /.col-lg-3 -->

          <div class="col-md-2 pull-right header-stats border-left hidden-xs hidden-sm">

            <span>45</span>
             <div class="dropdown">
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu4" data-toggle="dropdown">
                  Orders Today
                  <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu4">
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">This Month</a></li>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">This Year</a></li>
                 </ul>
              </div><!-- /.dropdown -->
          </div><!-- /.col-md-4 -->
          
          <div class="col-md-2 pull-right header-stats border-left hidden-xs hidden-sm">
             <span>$867.55</span>
             <div class="dropdown">
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu5" data-toggle="dropdown">
                  In Sales Today
                  <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu5">
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">This Month</a></li>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">This Year</a></li>
                 </ul>
              </div><!-- /.dropdown -->
          </div><!-- /.col-md-4 -->

        </div><!-- /.row -->

      </header>

  <div class="container content-wrapper">
     <div class="row">