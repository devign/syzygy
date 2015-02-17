<?php

/**** ADD A NEW PRODUCT ***/
if (isset($route[1]) && $route[1] === 'create') {
    if (isset($route[2]) && $route[2] === 'simple') {
        $include_file = 'product_create_simple.phtml';
    } else if (isset($route[2]) && $route[2] === 'variable') {
        $include_file = 'product_create_variable.phtml';
    } else if (isset($route[2]) && $route[2] === 'customizable') {   
        $include_file = 'product_create_customizable.phtml';
    } else if (isset($route[2]) && $route[2] === 'virtual') {
        $include_file = 'product_create_virtual.phtml';
    } else {
        $include_file = 'product_create.phtml';
    }  
/**** EDIT EXISTING PRODUCT ****/                                              
} else if (isset($route[1]) && $route[1] === 'edit') {
    if (isset($route[2]) && $route[2] === 'simple') {
        $include_file = 'product_edit_simple.phtml';
    } else if (isset($route[2]) && $route[2] === 'variable') {
        $include_file = 'product_edit_variable.phtml';
    } else if (isset($route[2]) && $route[2] === 'customizable') {   
        $include_file = 'product_edit_customizable.phtml';
    } else if (isset($route[2]) && $route[2] === 'virtual') {
        $include_file = 'product_edit_virtual.phtml';
    } else {
        $include_file = 'product_edit.phtml';
    }  
 
 /**** IMPORT NEW PRODUCTS ****/                                              
} else if (isset($route[1]) && $route[1] === 'import') {
    if (isset($route[2]) && $route[2] === 'simple') {
        $include_file = 'product_edit_simple.phtml';
    } else if (isset($route[2]) && $route[2] === 'variable') {
        $include_file = 'product_edit_variable.phtml';
    } else if (isset($route[2]) && $route[2] === 'customizable') {   
        $include_file = 'product_edit_customizable.phtml';
    } else if (isset($route[2]) && $route[2] === 'virtual') {
        $include_file = 'product_edit_virtual.phtml';
    } else {
        $include_file = 'product_edit.phtml';
    }  
    
       
/**** IF NOTHING MATCHES THEN WE WILL DISPLAY A LIST OF ITEMS *****/          
} else {
    if (isset($_GET['p']) && $_GET['p'] > 1) {
        $current_page = $_GET['p'];
        $_GET['p']--;
        $start = $_GET['p'] * $config['items_per_page'];
    
    } else {
        $current_page = 1;
        $start = 0;
    }

    if (isset($_POST['items_per_page'])) {
        $end = $_POST['items_per_page'];
    } else {
        $end = $config['items_per_page'];
    }
    
    

    $include_file = 'product_list.phtml';
} 

require THEME_PATH . 'header.phtml';
?>

<?php if (isset($include_file)) : ?>
    <?php require $include_file; ?>
<?php else : ?>
    <div>
        Whoops, I got nuthin' to display.
    </div>

<?php endif; ?>

<?php
    require THEME_PATH . 'footer.phtml';
?>