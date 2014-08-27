<?php
require_once 'init.php'; 


// GET CUSTOMER ID FROM POST or GET
$customer_id = getCustomerID();


$stmt = $db_connection->prepare("SELECT ship_address_id, company_name, first_name, last_name, address1, address2, city, state,
									postal_code, country
									FROM customer_ship_addresses
									WHERE customer_id = $customer_id");

$stmt->execute();
$result = $stmt->get_result();
?>

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
<div style="text-align:left">
	<div style="padding-bottom:20px;padding-top:20px">
		<?php while ($ship_info = $result->fetch_object()) :?>
			<div style="float:right;margin-right:50px">
			<a href="#" class="button" onClick="window.opener.location='order_new.php?cid=<?php echo $customer_id?>&ship_address_id=<?php echo $ship_info->ship_address_id?>';window.close();">Select</a>
			</div>
			<div style="margin-left: 60px;margin-bottom:20px;border-bottom:1px dotted #000">
				
				<?php echo ($ship_info->company_name ? $ship_info->company_name : $ship_info->first_name . ', ' . $ship_info->last_name)?> <br />
				<?php echo $ship_info->address1?><br />
				<?php if ($ship_info->address2) :?>
					<?php echo $ship_info->address2 ?><br />
				<?php endif?>
				<?php echo $ship_info->city . ', '.  $ship_info->state . ' ' .  $ship_info->postal_code?><br />
			
			</div>
		<?php endwhile?>
		
		<div class="inputLabel" style="margin-top:40px">ENTER NEW ADDRESS:</div>
		
		<form name="selectShipAddress" method="post" action="order_new.php">
		<input type="hidden" name="cid" value="<?php echo $customer_id?>">
		<input type="hidden" name="new_ship_address" value="1">
		<input type="hidden" name="type" value="<?php echo ($_POST['type'] ? isset($_POST['type']) : 'ORDER') ?>">
		<?php createInputForm('customer_ship_addresses') ?>
		
		</form>
	</div>

</div>

</body>

</html>

<?php 
	$stmt->close();
	
	dbDisconnect($db_connection);
		
?>
