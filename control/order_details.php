<?php
$calling_file = basename(__FILE__);
require_once 'init.php';
require_once 'header.php';


//print_r($_POST);

// GET ORDER NUMBER
$order_number = getOrderNumber();

// IF ORDER change_order_status FLAG IS SET, UPDATE ORDER STATUS
if (isset($_POST['change_order_status'])) {
	$update_status_query = "UPDATE orders SET order_status = '" . $_POST['order_status'] .
									"', order_date_event = NOW()";

	if ($_POST['order_status'] == 'IN PRODUCTION') {
		$update_status_query .= ", order_date_scheduled = NOW()";
	}

	if ($_POST['order_status'] == 'SHIPPED') {
		$update_status_query .= ", order_date_shipped = NOW()";
	}

	$update_status_query .= " WHERE order_number = " . $order_number;

	$result = $db_connection->query($update_status_query);


/*
	if (!$result) {
		$error_msg = 'ORDER STATUS WAS NOT UPDATED SUCCESFULLY';
		header("Location: order_details.php");
	} else {
		$status_msg = 'ORDER STATUS UPDATED SUCCESSFULLY';
		header("Location: order_details.php");
	}
*/

}

// SAVE LINE ITEM DETAILS IF save_line_details FLAG IS SET
if (isset($_POST['save_line_details'])) {

	$order_id = getOrderID($order_number);


	if (isset($_POST['personalization']) && $_POST['personalization'] != '') {
		$personalization = $db_connection->escape_string($_POST['personalization']);
	}

	if (isset($_POST['production_details']) && $_POST['production_details'] != '') {
		$production_details = $db_connection->escape_string($_POST['production_details']);
	}

	if (isset($_POST['line_notes']) && $_POST['line_notes'] != '') {
		$line_notes = $db_connection->escape_string($_POST['line_notes']);
	}


	$update_query = "UPDATE order_line_items SET personalization = '".  $personalization . "',
									production_details = '" . $production_details . "'";

	if (isset($_POST['line_notes']) && $_POST['line_notes'] != '') {
		$update_query .= ", line_notes = '" . $line_notes . "'";
	}

	$update_query .= " WHERE order_id = " . $order_id . " and line_no = " . $_POST['lineno'];

	$result = $db_connection->query($update_query);

/*
	echo "<script>document.getElementByID['logo'].display.value='block';</script>";


	if (!$result) {
		$error_msg = 'ORDER LINE DETAILS NOT UPDATED SUCCESSFULLY';
		header("Location: order_details.php");
	} else {
		$status_msg = 'ORDER LINE DETAILS UPDATED SUCCESSFULLY';
		header("Location: order_details.php");
	}
*/

}

// GET ORDER INFO
$result = $db_connection->query("SELECT c.company_name, c.customer_id, first_name, last_name, address1, address2, city, state, postal_code,
									country, ship_address_id, order_type, DATE_FORMAT(order_date, '%c/%e/%y') as order_date, ship_method,
                                                      DATE_FORMAT(order_date_promised, '%c/%e/%y') as order_date_promised, phone, order_status
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

$items_stmt = $db_connection->prepare("SELECT line_no, oli.quantity AS qty, p.description AS descp, oli.price AS price, oli.ext_price AS ext_price
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

	<div id="mainContainer">
		<div id="mainContainerLeft">
			<div>
				<h3><?= $order_info->order_type?>#: <?= $order_number?> || DATE: <?= $order_info->order_date?></h3>
			</div>
			<div style="float:left;margin-right: 30px">
				<div class="inputLabel">BILL TO:</div>
				<?= ($order_info->company_name ? $order_info->company_name : ($order_info->first_name . ', '. $order_info->last_name))?><br />
				<?= $order_info->address1 ?><br />
				<?php if ($order_info->address2) echo $order_info->address2 . '<br />' ?>
				<?= $order_info->city . ', ' . $order_info->state . ' ' . $order_info->postal_code ?><br />
				<?= format('phone', $order_info->phone)?>
			</div>

			<div style="float:left">
				<div class="inputLabel">SHIP TO:</div>
				<?php if ($order_info->ship_method != 'PICKUP') : ?>
					<?= ($ship_info->company_name ? $ship_info->company_name : ($ship_info->first_name . ', '. $ship_info->last_name))?><br />
					<?= $ship_info->address1 ?><br />
					<?php if ($ship_info->address2) echo $ship_info->address2 . '<br />'?>
					<?= $ship_info->city . ', ' . $ship_info->state . ' ' . $ship_info->postal_code ?><br />
				<?php else : ?>
					<?= 'CUSTOMER PICKUP'?><br />
				<?php endif ?>

				</div>
			<div style="clear:both;padding-top:20px">
				<span class="inputLabel" style="margin-right:10px">SHIP VIA:</span> <?= $order_info->ship_method?>
				<span class="inputLabel">DATE PROMISED:</span> <?= $order_info->order_date_promised?>
			</div>
			<div id="lineItemDetails">

				<?php if (isset($_POST['line_detail']) && $_POST['line_detail'] === 'GET') : ?>
					<form name="orderLineItemDetails" method="post">
					<input type="hidden" name="save_line_details" value="1">
					<input type="hidden" name="line_detail" value="GET">
					<input type="hidden" name="onum" value="<?= $order_number?>">
					<table class="lineDetails">
					<tr><th colspan="3">ORDER LINE ITEM DETAILS</th></tr>
					<?php
							$lineno = $_POST['lineno'];

							$result = $db_connection->query("SELECT sku, personalization, production_details, line_notes
															FROM orders
															LEFT JOIN order_line_items USING(order_id)
															LEFT JOIN products USING(product_id)
															WHERE order_number = '$order_number'
															and line_no = $lineno");

							$line_details = $result->fetch_object();
							$result->close();


							if (isset($line_details->personalization)) {
								$personals = fixLineEndings($line_details->personalization);
							} else {
								$personals = NULL;
							}

							if (isset($line_details->production_details)) {
								$prod_details = fixLineEndings($line_details->production_details);
							} else {
								$prod_details = NULL;
							}

							if (isset($line_details->line_notes)) {
								$notes = fixLineEndings($line_details->line_notes);
							} else {
								$notes = NULL;
							}

					?>
							<input type="hidden" name="lineno" value="<?= $lineno?>">
							<tr><td colspan="3"><strong>SKU:</strong> <?= $line_details->sku?></td></tr>
							<tr><td colspan="3"><strong>PERSONALIZATION:</strong><br />
							<textarea class="orderDetailInfo" name="personalization"><?php if (isset($personals)) echo $personals?></textarea>
							</td></tr>
							<tr><td colspan="3"><strong>PRODUCTION DETAILS:</strong><br />
							<textarea class="orderDetailInfo" name="production_details"><?php if (isset($prod_details)) echo $prod_details?></textarea>
							</td></tr>
							<tr><td colspan="3"><strong>NOTES:</strong><br />
							<textarea class="orderDetailInfo" name="line_notes"><?php if (isset($notes)) echo $notes ?></textarea>
							</td></tr>
					</table>
					<div style="float:right;margin-top:5px">
						<input class="button" type="submit" name="submit" value="SAVE">
					</div>
					</form>

				<?php endif ?>

			</div>
		</div>

		<div id="mainContainerRight">
			<div id="divisionHead"><?= $order_info->order_type?> DETAILS</div>
			<?php if ($order_info->order_type == 'QUOTE') :?>
				<div style="float:right; margin-right:60px;margin-top:-10px">
				<a class="button" href="convert_quote_to_order.php?onum=<?= $order_number?>">CONVERT TO ORDER</a>
				</div>
			<?php else : ?>

				<?php $option_values = getColumnSetValues('orders', 'order_status')?>

				<div style="float:right; margin-right:60px;margin-top:-10px">

				<form method="post" name="orderStatus">
				<input type="hidden" name="change_order_status" value="1">
				<input type="hidden" name="onum" value="<?= $order_number?>">
				<span class="inputLabel">STATUS:</span> <select name="order_status" onChange="this.form.submit()">
				<option value="<?= $order_info->order_status?>"><?= $order_info->order_status?></option>

					<?php foreach ($option_values as $value) : ?>
						<?php if ($value != $order_info->order_status) :?>
							<option value="<?= $value?>"><?= $value?></option>
						<?php endif ?>
					<?php endforeach ?>

				</select>
				</form>
				</div>
			<?php endif ?>
			<form name="orderDetails" method="post">
			<input type="hidden" name="onum" value="<?= $order_number?>">
			<input type="hidden" name="line_detail" value="GET">
			<input type="hidden" name="lineno" value="">
			<table class="detailsList">
				<tr><th>QUANTITY</th><th>DESCRIPTION</th><th>PRICE</th><th>EXT. PRICE</th></tr>
			<?php while ($result = $items_result->fetch_object()) : ?>
				<tr class="clickable" onClick="document.orderDetails.lineno.value=<?= $result->line_no?>;document.orderDetails.submit()"><td ><?= $result->qty?></td><td><?= $result->descp?></td><td><?= $result->price?></td>
						<td><?= $result->ext_price?></td></tr>

			<?php endwhile ?>

<?php
	$order_totals = getOrderTotals($order_number);


?>
			<tr><td colspan="3">SUBTOTAL</td><td><?= '$' . sprintf('%0.2f', $order_totals[0])?></td></tr>
			<tr><td colspan="3">DISCOUNT</td><td><?= '$' . sprintf('%0.2f', $order_totals[3])?></td></tr>
			<tr><td colspan="3">SHIPPING</td><td><?= '$' . sprintf('%0.2f', $order_totals[1])?></td></tr>
			<tr><td colspan="3">SALESTAX</td><td><?= '$' . sprintf('%0.2f', $order_totals[2])?></td></tr>
			<tr><td colspan="3">ORDER TOTAL</td><td><?= '$' . sprintf('%0.2f', $order_totals[4	])?></td></tr>
			</table>
			</form>
		</div>
	</div>

</div>

</body>

