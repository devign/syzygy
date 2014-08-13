<?php

spl_autoload_register(function ($class) {
    include 'classes/' . $class . '.php';
});

echo "LET'S ROCK THIS MUTHA!";
  
?>
