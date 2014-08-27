<?php
$calling_file = basename(__FILE__);
require_once 'init.php';
require_once 'header.php';


// GET CUSTOMER ID
$customer_id = getCustomerID();


if (isset($action) && $action == 'search') {

	$search_on = $_POST['search_value'];

	$main_query = "SELECT c.customer_id, company_name, city, state, MAX(o.order_number) as order_number, sales_rep
							FROM customers c, orders o, customer_contacts cc
							WHERE o.customer_id = c.customer_id
							AND c.customer_id = cc.customer_id
							AND c.account_number LIKE '%". $search_on . "%'
							OR c.company_name LIKE '%". $search_on . "%'
							OR c.first_name LIKE '%". $search_on . "%'
							OR c.last_name LIKE '%". $search_on . "%'
						 	OR c.city LIKE '%". $search_on . "%'
						 	OR c.phone LIKE '%". $search_on . "%'
						 	OR c.billing_email LIKE '%". $search_on . "%'";


	$main_stmt = $db_connection->query($main_query);


} else {

	$main_stmt = $db_connection->query("SELECT c.customer_id, c.first_name, c.last_name, c.company_name, c.city, c.state, MAX(o.order_number) as order_number, sales_rep
			  	FROM customers c, orders o
				WHERE c.customer_id = o.customer_id
				GROUP BY c.customer_id
				ORDER BY c.company_name, c.last_name
				");

}


if (isset($customer_id)) {

	$customer_stmt = $db_connection->query("SELECT company_name, first_name, last_name FROM customers WHERE customer_id = $customer_id");

	$customer_stmt->execute;

	$customer_result = $customer_stmt->fetch_object();

	$customer_stmt->close();

	$orders_stmt = $db_connection->query("SELECT order_number, order_status, order_date_event
				FROM orders
				WHERE customer_id = $customer_id");

	$orders_stmt->execute;

}



?>

	<div id="mainContainer">
		<div id="mainContainerLeft">
			<form name="searchForm" action="customers.php" method="post">
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

			<?php if (isset($customer_id)) : ?>
			<div id="customerOrders">
				<table class="lineDetails">
				<tr><th colspan="3">ORDER SUMMARY FOR <?= $customer_result->company_name ?></th></tr>


				<?php while ($result = $orders_stmt->fetch_object()) : ?>
					<tr><td><a href="order_details.php?onum=<?= $result->order_number?>&cid=<?= $customer_id?>"><?= $result->order_number ?></a></td>
								<td><?= $result->order_status ?></td><td><?= $result->order_date_event ?></td></tr>
				<?php endwhile ?>


				</table>
			</div>
			<?php endif ?>
		</div>

		<div id="mainContainerRight">
			<form name="customersForm" method="post" action="customers.php">
			<input type="hidden" name="cid" value="">
			<table class="detailsList">
				<tr><th>CUSTOMER NAME</th><th>CITY</th><th>STATE</th><th>LAST ORDER#</th><th>SALES REP</th></tr>

			<?php

				while ($result = $main_stmt->fetch_object()) {
					print "<tr class=\"clickable\" onClick=\"document.customersForm.cid.value='$result->customer_id';document.customersForm.submit()\"><td><a href=\"customer_details.php?cid=$result->customer_id\">";

					if (isset($result->company_name)) {
						print $result->company_name;
					} else {
						print $result->last_name . ', ' . $result->first_name;
					}

					print "</a></td><td>$result->city</td><td>$result->state</td><td>$result->order_number</td><td>$result->sales_rep</td></tr>";

				}
			?>

			</table>
			</form>
		</div>
	</div>

</div>

</body>

<?php
	dbDisconnect($db_connection);
?>