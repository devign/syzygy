<?php
require_once 'init.php'; 

?>


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
		<input type="hidden" name="caller" value="<?php echo $_GET['caller']?>">
		
	<?php 
	
		$hide_fields = array('status');
		createInputForm('products', $hide_fields);
	
	?>
		
		</form>
	</div>

</div>

<?php endif ?>

<?php 
	dbDisconnect($db_connection);
?>