<?php
class View {
    
    public function __construct() {
        echo 'This is a view';
    }
    
    public function render($name) {
        require 'views/' . $name . '.php';
    }
}
?>
