<?php
require_once 'init.php';

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

<?php if (isset($action) && $action == 'create_store') : ?>

<?php


	$stores_id = insertRecord('stores');

	$_POST['store_id'] = $store_id;


?>


<div style="padding-top:100px">
	<h3>STORE SUCCESSFULLY ADDED</h3>
</div>
<div>
	<button class="button" onCLick="window.opener.location='<?php echo $_POST['caller']?>';window.close()">CLOSE</button>

</div>

<?php else : ?>

<div>
	<div style="padding:20px">
		<h3>ENTER STORE INFORMATION</h3>
		<form name="productNew" method="post" enctype="multipart/form-data">
		<input type="hidden" name="action" value="create_store">
		<input type="hidden" name="caller" value="<?php echo $_GET['caller']?>">

	<?php


		createInputForm('stores');

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