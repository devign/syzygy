<?php
$calling_file = basename(__FILE__);
require_once 'init.php';
require_once 'header.php';

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

	$main_stmt = $db_connection->query("SELECT *
			  	FROM products");

}


if (isset($product_id)) {

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
    <h1 class="admin">Product List</h1>
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

    </div>

    <div id="mainContainerRight">

    	<form name="customersForm" method="post" action="customers.php">
    	<input type="hidden" name="cid" value="">
    	<div style="width:590px;overflow:auto;height:560px">
      	<table class="detailsList">
      		<tr><th>SKU</th><th>NAME</th><th>DESCRIPTION</th><th>PRICE</th><th>WEIGHT</th><th>STATUS</th>
      		<th>SUPPLIER</th></tr>

      	<?php while ($result = $main_stmt->fetch_object()) : ?>
      		<tr onClick="document.productsForm.pid.value='<?= $result->product_id ?>';document.customersForm.submit()">
      		<td><a href="javascript: overlayWindow('product_edit.php?pid=<?= $result->product_id ?>', 400, 500)"><?= $result->sku ?></a></td>
      		<td><?= $result->name ?></td><td><?= $result->description ?></td><td><?= $result->price ?></td><td><?= $result->weight ?></td>
      		<td><?= $result->status ?></td><td><?= $result->supplier_id ?></td></tr>
      	<?php endwhile ?>

      	</table>
    	</div>
    	</form>
    </div>
  </div>

</div>

</body>

<?php
	dbDisconnect($db_connection);
?>