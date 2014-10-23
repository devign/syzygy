<?php

$error_msg = [];
 
$config = array(
    'domain'                        => 'syzygy.dev',
    'db'                           => 'ecomm_sample',
    'dbuser'                       => 'bbddev',
    'dbpwd'                        => '1stank-mofo',
    'dbhost'                       => 'localhost',
    'stylesheet_directory'         => 'css/',
    'javascript_directory'         => 'control/js/',
    'image_directory'              => 'images/',
    'login_instructions'           => 'Enter you username and password to log in.',
    'time_zone'                    => 'America/Chicago',
    'order_number_seed'            => '10010',
    'theme'                         => 'default',
    'media_upload'                  => 'media/',
    'root_dir'                      => '/home/data/devign-llc/dev/syzygy/',
);

$supported_media = array(
            'jpg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
            'pdf' => 'application/pdf',
            'flv' => 'video/x-flv',
            'mp4' => 'video/mp4',
            'mov' => 'video/quicktime',
            'avi' => 'video/x-msvideo',
            'wmv' => 'video/x-ms-wmv'
);
        
$lowercase_fields = array();

define('DSEP', '/');
define('SITE_PATH', realpath(dirname(__FILE__)) . DSEP);
define('THEME_PATH', SITE_PATH . '/themes/'. $config['theme'] . DSEP);
  
?>
