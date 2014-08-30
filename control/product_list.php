<?php


if (isset($action) && $action == 'search') {

	$search_on = $_POST['search_value'];

	$main_query = "SELECT sku, name, description, price FROM products";

	$main_stmt = $db->query($main_query);


} else {

	$main_stmt = $db->query("SELECT * FROM products");

}


if (isset($product_id)) {

	$customer_stmt = $db->query("SELECT company_name, first_name, last_name FROM customers WHERE customer_id = $customer_id");

	$customer_stmt->execute;

	$customer_result = $customer_stmt->fetch_object();

	$customer_stmt->close();

	$orders_stmt = $db_connection->query("SELECT order_number, order_status, order_date_event
				FROM orders
				WHERE customer_id = $customer_id");

	$orders_stmt->execute;

}



?>
          <div class="col-xs-12 col-md-9">
             
            <section id="page-header">

              <h1><span class="glyphicon glyphicon-home"></span>Products List</h1>

            </section>

            <section id="content">
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

    	<form name="productsForm" method="post" action="products.php">
    	<input type="hidden" name="cid" value="">
    	<div style="width:590px;overflow:auto;height:560px">
      	<table class="detailsList">
      		<tr><th>SKU</th><th>NAME</th><th>DESCRIPTION</th><th>PRICE</th><th>WEIGHT</th><th>STATUS</th>
      		<th>SUPPLIER</th></tr>

      	<?php while ($result = $main_stmt->fetch_object()) : ?>
      		<tr onClick="document.productsForm.pid.value='<?= $result->sku ?>';document.customersForm.submit()">
      		<td><a href="javascript: overlayWindow('product_edit.php?pid=<?= $result->sku ?>', 400, 500)"><?= $result->sku ?></a></td>
      		<td><?= $result->name ?></td><td><?= $result->description ?></td><td><?= $result->price ?></td>
      	<?php endwhile ?>

      	</table>
    	</div>
    	</form>
    </div>


            </section>

          </div><!-- /.col-sm-12 /.col-lg-9 -->