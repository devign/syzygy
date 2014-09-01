<?php
require_once 'functions.php';

?>

          <div class="col-xs-12 col-md-9">
             
            <section id="page-header">

              <h1><span class="glyphicon glyphicon-home"></span> Products</h1>

            </section>

            <section id="content">

<?php if (isset($action) && $action == 'create_product') : ?>

<?php 

	$product_id = insertRecord('products');
	
	$_POST['product_id'] = $product_id;
	
	
?>


<div style="padding-top:100px">
	<h3>PRODUCT SUCCESSFULLY ADDED</h3>
</div>
<div>
	<button class="button" onCLick="window.opener.location='<?php echo $_POST['caller']?>';window.close()">CLOSE</button>
	
</div>

<?php else : ?>

<div>
	<div style="padding:20px">
		<h3>ENTER PRODUCT INFORMATION</h3>
		<form name="productNew" method="post">
		<input type="hidden" name="action" value="create_product">

		
	<?php 
	
		$hide_fields = array('status');
		createInputForm('products', $hide_fields);
	
	?>
		
		</form>
	</div>

</div>

<?php endif ?>

            </section>

          </div><!-- /.col-sm-12 /.col-lg-9 -->