<?php
require_once 'init.php'; 

?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>HotWorkOrders</title>
  	<link rel="Stylesheet" href="<?php echo $config['stylesheet_directory']?>main.css" />
<style>
	body {
		background: #F4F0BB;
	}
</style>
</head>

<body>

<?php if (isset($action) && $action == 'create_supplier') : ?>

<?php 
	

	$supplier_id = insertRecord('suppliers');
	
	$_POST['supplier_id'] = $supplier_id;
	
	
?>


<div style="padding-top:100px">
	<h3>SUPPLIER SUCCESSFULLY ADDED</h3>
</div>
<div>
	<button class="button" onCLick="window.opener.location='<?php echo $_POST['caller']?>';window.close()">CLOSE</button>
	
</div>

<?php else : ?>

<div>
	<div style="padding:20px">
		<h3>ENTER SUPPLIER INFORMATION</h3>
		<form name="supplierNew" method="post">
		<input type="hidden" name="action" value="create_supplier">
		<input type="hidden" name="caller" value="<?php echo $_GET['caller']?>">
		
	<?php 
	
		createInputForm('suppliers', $hide_fields);
	
	?>
		
		</form>
	</div>

</div>

<?php endif ?>

</body>
</html>

<?php 
	dbDisconnect($db_connection);
?>