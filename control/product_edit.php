<?php
require_once 'init.php'; 

?>

<?php 

	$result = $db_connection->query("SELECT * FROM products WHERE product_id = " . $_GET['pid']);
	$prod_info = $result->fetch_object();
	$result->close();
	
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>HotWorkOrders</title>
  	<link rel="Stylesheet" href="<?php echo $config['stylesheet_directory']?>main.css" />
  	<script type="text/javascript" src="<?php echo $config['javascript_directory']?>functions.js"></script>
<style>
	body {
		background: #F4F0BB;
	}
</style>
</head>

<body>

<?php if (isset($action) && $action == 'update_product') : ?>

<?php 

	$product_id = insertRecord('products');
	
	$_POST['product_id'] = $product_id;
	
	
?>


<div style="padding-top:100px">
	<h3>PRODUCT SUCCESSFULLY SAVED</h3>
</div>
<div>
	<button class="button" onCLick="window.opener.location='<?php echo $_POST['caller']?>';window.close()">CLOSE</button>
	
</div>

<?php else : ?>

<div>
	<div style="padding:20px">
		<h3>EDIT PRODUCT INFORMATION</h3>
		<form name="productNew" method="post">
		<input type="hidden" name="action" value="update_product">
		<input type="hidden" name="pid" value="<?= $prod_info->product_id ?>">
		<input type="hidden" name="caller" value="<?php echo $_GET['caller']?>">
		
		<table>
		<tr><td>SKU:</td><td><input type="text" name="sku" value="<?= $prod_info->sku ?>" size="30"></td></tr>		
		<tr><td>NAME:</td><td><input type="text" name="name" value="<?= $prod_info->name ?>" size="30"></td></tr>
		<tr><td>DESCRIPTION:</td><td><input type="text" name="description" value="<?= $prod_info->description ?>" size="30"></td></tr>
		<tr><td>PRICE:</td><td><input type="text" name="price" value="<?= $prod_info->price ?>" size="30"></td></tr>
		<tr><td>WEIGHT:</td><td><input type="text" name="weight" value="<?= $prod_info->weight ?>" size="30"></td></tr>
		<tr><td>STATUS:</td><td><input type="text" name="status" value="<?= $prod_info->status ?>" size="30"></td></tr>
		<tr><td>SUPPLIER:</td><td><input type="text" name="supplier" value="<?= $prod_info->supplier ?>" size="30"></td></tr>
		</table> 
	
		<input type="submit" value="SAVE"> <input type="reset" value="CANCEL" onClick="window.close()">		
		</form>
	</div>

</div>

<?php endif ?>

</body>
</html>

<?php 
	dbDisconnect($db_connection);
?>