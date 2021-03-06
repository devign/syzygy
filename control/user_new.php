<?php
require_once 'init.php';

?>

<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>HotWorkOrders</title>
  <link rel="Stylesheet" href="<?= $config['stylesheet_directory']?>main.css" />
  <script type="text/javascript" src="<?= $config['javascript_directory']?>functions.js"></script>
<style>
	body {
		background: #F4F0BB;
	}
</style>
</head>

<body>

<?php if (isset($action) && $action == 'create_user') : ?>

<?php
	$associate_id = insertRecord('associates', 'associate_id');

	$_POST['associate_id'] = $associate_id;

	insertRecord('stores_associates');

?>


<div style="padding-top:100px">
	<h3>ASSOCIATE SUCCESSFULLY ADDED</h3>
</div>
<div>
	<button class="button" onCLick="window.opener.location='<?= $_POST['caller']?>';window.close()">CLOSE</button>

</div>

<?php else : ?>

<div>
	<div style="padding:20px">
		<h3>ENTER USER INFORMATION</h3>
		<form name="userNew" method="post">
		<input type="hidden" name="action" value="create_user">
		<input type="hidden" name="caller" value="<?= $_GET['caller']?>">

	<?php
		createInputForm('associates');
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