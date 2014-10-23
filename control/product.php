<?php

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
} else {
    if (isset($_GET['list_start'])) {
        $start = $_GET['list_start'];
    } else {
        $start = 0;
    }
    if (isset($_GET['list_end'])) {
        $end = $_GET['list_end'];
    } else {
        $end = 10;
    }
    $include_file = 'product_list.phtml';
} 

require THEME_PATH . 'header.phtml';
?>

<?php if (isset($include_file)) : ?>
    <?php require $include_file; ?>
<?php else : ?>

          <div class="col-xs-12 col-md-9">
             
            <section id="page-header">

              <h1><span class="glyphicon glyphicon-home"></span>Products</h1>

            </section>

            <section id="content">
	<div id="mainContainerLeft">
		<div style="padding-top:30px;padding-left:30px">
		<a class="button" href="javascript:void overlayWindow('product_new.php?caller=products.php', '480', '500')">Add Product</a>
		</div>
		<div style="padding-top:30px;padding-left:30px">
		<a class="button" href="/control/product_list">List Products</a>
		</div>
		
	</div>
	
	<div id="mainContainerRight">
	
	</div>

            </section>

          </div><!-- /.col-sm-12 /.col-lg-9 -->
          
<?php endif; ?>

<?php
    require THEME_PATH . 'footer.phtml';
?>