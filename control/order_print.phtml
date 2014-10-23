<?php
require_once 'init.php'; 


$order_number = getOrderNumber();

// GET STORE INFO
$result = $db_connection->query("SELECT address1, city, state, postal_code, phone FROM stores WHERE store_id = " . $_COOKIE['HWO_STOREID']);

$store_info = $result->fetch_object();

$result->close();

// GET ORDER INFO
$result = $db_connection->query("SELECT c.company_name, c.customer_id, first_name, last_name, address1, address2, city, state, postal_code,
									country, ship_address_id, order_type, order_date, ship_method, order_date_promised, phone, order_status
									FROM orders o, customers c
									WHERE o.order_number = $order_number
									and c.customer_id = o.customer_id");

$order_info = $result->fetch_object();

$result->close();

// GET SHIPPING ADDRESS
if ($order_info->ship_method != 'PICKUP') {
	$result = $db_connection->query("SELECT company_name, first_name, last_name, address1, address2, city, state, postal_code, country
								FROM customer_ship_addresses 
								WHERE customer_id = $order_info->customer_id
								AND ship_address_id = $order_info->ship_address_id");
	
	$ship_info = $result->fetch_object();
	
	$result->close();
}

$items_stmt = $db_connection->prepare("SELECT line_no, oli.quantity AS qty, p.sku, p.description AS descp, oli.price AS price, oli.ext_price AS ext_price
									FROM products AS p
									LEFT JOIN order_line_items AS oli USING(product_id)
									LEFT JOIN orders AS o USING(order_id)
									WHERE o.order_number = $order_number");

$items_stmt->execute();

$items_result = $items_stmt->get_result();

if (isset($_POST['line_no'])) {
	$lineno = $_POST['line_no'];
	$item_stmt = $db_connection->query("SELECT personalization, production_details
			FROM order_line_items 
			WHERE order_number = $order_number
			AND line_no = '$lineno'");	
	
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>HotWorkOrders</title>
  	<link rel="Stylesheet" href="<?php echo $config['stylesheet_directory']?>print.css" />
<style>
	body {
		background: #FFF;
	}
</style>
</head>

<body>
<div id="pageContainer">
	<div id="head">
		<div id="logo">
			<img src="images/<?php echo $config['print_logo']?>" alt="logo" width="300px"/>
			<div>
			<?=$store_info->address ?><br />
			<?=$store_info->city ?>, <?=$store_info->state ?> <?=$store_info->postal_code ?><br />
			<?php $formatted_phone = format('phone', $store_info->phone); ?>
			<?=$formatted_phone?>
			</div>
		</div>
		<div id="pageTitle">
			<h1>WORK ORDER</h1>
		</div>
	</div>
	<div id="infoHead">
			<div style="float: right"><h3><?php echo $order_info->order_type?>#: <?php echo $order_number?></h3></div>	
		DATE TAKEN: <?php echo $order_info->order_date?> <br />
		DATE PROMISED: <?php echo $order_info->order_date_promised?>

	</div>
	<div id="mainContainer">
			
			<div class="infoPanel" style="margin-right: 100px">
				<div class="sectionLabel">CUSTOMER INFO:</div>
				<?php echo ($order_info->company_name ? $order_info->company_name : ($order_info->first_name . ', '. $order_info->last_name))?><br />
				<?php echo $order_info->address1 ?><br />
				<?php if ($order_info->address2) echo $order_info->address2 . '<br />' ?>
				<?php echo $order_info->city . ', ' . $order_info->state . ' ' . $order_info->postal_code ?><br />
				<?php echo format('phone', $order_info->phone)?>
			</div>
			
			<div class="infoPanel">
				<div class="sectionLabel">SHIP TO:</div>
				<?php if ($order_info->ship_method != 'PICKUP') : ?>
					<?php echo ($ship_info->company_name ? $ship_info->company_name : ($ship_info->first_name . ', '. $ship_info->last_name))?><br />
					<?php echo $ship_info->address1 ?><br />
					<?php if ($ship_info->address2) echo $ship_info->address2 . '<br />'?>
					<?php echo $ship_info->city . ', ' . $ship_info->state . ' ' . $ship_info->postal_code ?><br />	
				<?php else : ?>
					<?php echo 'CUSTOMER PICKUP'?><br />
				<?php endif ?>
	
				
				<div style="clear:both;padding-top:20px">
					<span class="sectionLabel">SHIP VIA:</span> <?php echo $order_info->ship_method?>
				</div>
			</div>		


			<table id="main">
				<tr><th style="width:100px">QUANTITY</th><th style="width:170px">SKU</th><th style="width: 280px">DESCRIPTION</th><th style="width:100px">PRICE</th><th style="width:100px">EXT. PRICE</th></tr>
				<tr><th colspan="2">PERSONALIZATION</th><th>PRODUCTION DETAILS</th><th colspan="2">NOTES</th></tr>
			<?php while ($result = $items_result->fetch_object()) : ?>
				<tr><td ><?php echo $result->qty?></td><td><?php echo $result->sku?></td><td><?php echo $result->descp?></td><td style="text-align:center"><?php echo $result->price?></td>
						<td style="text-align:right"><?php echo $result->ext_price?></td></tr>	
						
						<?php
							
							$result = $db_connection->query("SELECT sku, personalization, production_details, line_notes 
															FROM orders 
															LEFT JOIN order_line_items USING(order_id)
															LEFT JOIN products USING(product_id)
															WHERE order_number = '$order_number'
															and line_no = $result->line_no");
							
							$line_details = $result->fetch_object();
							$result->close();
							
					
							if (isset($line_details->personalization)) {
								$personals = preg_replace('/\\\r\\\n/', "<br />", $line_details->personalization);
							} else {
								$personals = NULL;
							}				
								
							if (isset($line_details->production_details)) {
								$prod_details = preg_replace('/\\\r\\\n/', "<br />", $line_details->production_details);
							} else {
								$prod_details = NULL;
							}
														
							if (isset($line_details->line_notes)) {
								$notes = preg_replace('/\\\r\\\n/', "<br />", $line_details->line_notes);
							} else {
								$notes = NULL;
							}
							
					?>		
							<tr><td colspan="5">
								<table class="inside">
								<tr><td style="width:280px"><?php if (isset($personals)) echo $personals?></td>
								<td style="width:260px"><?php if (isset($prod_details)) echo $prod_details?></td>
								<td><?php if (isset($notes)) echo $notes ?></td>
								</tr>
								</table>
							</td></tr>
						
			<?php endwhile ?>	
				
					
<?php 
	$order_totals = getOrderTotals($order_number);
	

?>						
			<tr><td colspan="4" style="text-align:right">SUBTOTAL</td><td style="text-align:right"><?php echo '$' . sprintf('%0.2f', $order_totals[0])?></td></tr>
			<tr><td colspan="4" style="text-align:right">DISCOUNT</td><td style="text-align:right"><?php echo '$' . sprintf('%0.2f', $order_totals[3])?></td></tr>
			<tr><td colspan="4" style="text-align:right">SHIPPING</td><td style="text-align:right"><?php echo '$' . sprintf('%0.2f', $order_totals[1])?></td></tr>
			<tr><td colspan="4" style="text-align:right">SALESTAX</td><td style="text-align:right"><?php echo '$' . sprintf('%0.2f', $order_totals[2])?></td></tr>
			<tr><td colspan="4" style="text-align:right">ORDER TOTAL</td><td style="text-align:right"><?php echo '$' . sprintf('%0.2f', $order_totals[4	])?></td></tr>
			</table>
		
		</div>
</div>

</body>
<div>
<button class="button" name="btnPrint" onClick="window.print();">PRINT</button>
<button class="button" name="btnClose" onClick="window.close();">CLOSE</button>
</div>

</body>
</html>
