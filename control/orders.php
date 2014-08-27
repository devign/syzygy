<?php
$calling_file = basename(__FILE__);
require_once 'init.php';
require_once 'header.php';


// GET CUSTOMER ID
$customer_id = getCustomerID();

if (isset($action) && $action == 'search') {

	$search_on = $_POST['search_value'];

	$orders_query = "SELECT DISTINCT o.order_id, o.order_number, c.customer_id, o.order_date, c.company_name,
							c.first_name, c.last_name, o.order_status, o.order_type
							FROM orders o
							LEFT JOIN customers c USING(customer_id)
							WHERE c.company_name REGEXP '". $search_on . "'
							OR c.first_name REGEXP '". $search_on . "'
							OR c.last_name REGEXP '". $search_on . "'
						 	OR c.city REGEXP '". $search_on . "'
						 	OR c.phone REGEXP '". $search_on . "'
						 	OR c.billing_email REGEXP '". $search_on . "'";


} else {

	$orders_query = "SELECT o.order_id, o.order_number, c.customer_id, o.order_date, c.company_name,
										c.first_name, c.last_name, o.order_status, o.order_type
										FROM orders AS o
										LEFT JOIN customers AS c USING(customer_id)";
	if (isset($customer_id)) {
		$orders_query .= " WHERE c.customer_id = $customer_id";
		if (isset($_POST['order_status']) && $_POST['order_status'] != 'ALL') {
			$orders_query .= " AND o.order_status = '" . $_POST['order_status'] . "'";
		}
		$orders_query .= " AND o.order_status != 'CLOSED' ORDER BY 1 ASC";
	} else {
		$orders_query .= " WHERE o.order_status != 'CLOSED'";
		if (isset($_POST['order_status']) && $_POST['order_status'] != 'ALL') {
			$orders_query .= " AND o.order_status = '" . $_POST['order_status'] . "'";
		}

		$orders_query .= " ORDER BY 1 ASC";
	}

}

$stmt = $db_connection->prepare($orders_query);
$stmt->execute();
$result = $stmt->get_result();

if (isset($_POST['items']) && $_POST['items'] === 'GET') {
	$db_connection2 = dbConnect();

	$stmt2 = $db_connection2->prepare("SELECT quantity, sku
										FROM order_line_items
										LEFT JOIN products USING(product_id)
										WHERE order_id = " . $_POST['oid']);
	$stmt2->execute();
	$stmt2->bind_result($qty, $sku);

}

?>

	<div id="mainContainer">
		<div id="mainContainerLeft">
			<form name="searchForm" action="orders.php" method="post">
			<input type="hidden" name="action" value="search">
			<div id="searchCriteria">

				<table>
					<tr><td class="inputLabel">SEARCH: </td><td><input type="text" name="search_value" value="" size="30"></td>
				</table>
			</div>
			<div id="searchButtonContainer">
				<button class="button" onClick="searchForm.submit();">GO!</button>
			</div>
			</form>


			<div id="customerOrders">
				<?php if (isset($_POST['items']) && $_POST['items'] === 'GET') : ?>
				<table class="lineDetails">
				<tr><th colspan="3">ORDER LINE ITEMS</th></tr>
					<?php while($stmt2->fetch()) : ?>
					<tr><td><?php echo $qty?></td><td><?php echo $sku?></td></tr>
					<?php endwhile ?>


				</table>
				<?php $stmt2->close() ?>
				<?php endif ?>

			</div>
		</div>

		<div id="mainContainerRight">
			<div class="filters">
				<form name="filterOrderStatus" method="post">

				<span class="inputLabel">ORDER STATUS:</span> <select name="order_status" onChange="this.form.submit()">
			<?php if (isset($_POST['order_status'])) : ?>
				<option value="<?php echo $_POST['order_status']?>"><?php echo $_POST['order_status']?></option>
			<?php endif ?>
				<option value="ALL">ALL</option>


			<?php
				$order_stati = getColumnSetValues('orders', 'order_status');
			?>

			<?php foreach ($order_stati as $status) : ?>
				<?php if ($order_stati != $_POST['order_status']) : ?>
					<option value="<?php echo $status?>"><?php echo $status?></option>
				<?php endif ?>
			<?php endforeach ?>

				</select>
				</form>
			</div>
			<div style="width:590px;overflow:auto;height:560px">
			<form name="orderItems" method="post">
			<input type="hidden" name="oid" value="">
			<input type="hidden" name="order_status" value="<?= $_POST['order_status']?>">
			<input type="hidden" name="items" value="GET">
			<?php if (isset($action) && $action == 'search') :?>
				<input type="hidden" name="action" value="<?php echo $action?>">
				<input type="hidden" name="search_value" value="<?php echo $_POST['search_value']?>">
			<?php endif ?>
			<table id="items" class="detailsList">

				<tr><th>ORDER #</th><th>ORDER DATE</th><th>CUSTOMER</th><th>STATUS</th><th>TYPE</th></tr>
			<?php



				while ($data = $result->fetch_object()) {
					if (((isset($_POST['onum']) && $_POST['onum'] != '' && $_POST['onum'] == $data->order_number) ||
									(isset($_POST['oid']) && $_POST['oid']) != '') && $_POST['oid'] == $data->order_id) {
						$row_style = "id=\"rowSelected\"";
					} else {
						$row_style = '';
					}
					print "<tr class=\"clickable\"><td $row_style><a href=\"order_details.php?onum=$data->order_number\">$data->order_number</a></td>
							<td onClick=\"document.orderItems.oid.value='$data->order_id';document.orderItems.order_status.value='$data->order_status';document.orderItems.submit()\">$data->order_date</td>
							<td onClick=\"document.orderItems.oid.value='$data->order_id';document.orderItems.order_status.value='$data->order_status';document.orderItems.submit()\">";

					if (isset($data->company_name)) {
						print $data->company_name;
					} else {
						print $data->last_name . ', ' . $data->first_name;
					}

					print "</td><td onClick=\"document.orderItems.oid.value='$data->order_id';document.orderItems.order_status.value='$data->order_status';document.orderItems.submit()\">$data->order_status</td>
					<td onClick=\"document.orderItems.oid.value='$data->order_id';document.orderItems.order_status.value='$data->order_status';document.orderItems.submit()\">$data->order_type</td></tr>";
				}


			?>
			</table>
			</form>
			</div>
		</div>
	</div>

</div>

</body>

<?php


	$stmt->close();

	dbDisconnect($db_connection);
?>