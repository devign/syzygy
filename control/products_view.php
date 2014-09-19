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

              <div id="searchCriteria" style="float:right;">
              <form name="searchForm" action="customers.php" method="post">
              <input type="hidden" name="action" value="search">
              <span class="inputLabel">SEARCH: <input type="text" name="search_value" value="" size="20">

              <button class="button" onClick="searchForm.submit();">GO!</button>

              </form>
              </div>
              <h1><span class="glyphicon glyphicon-shopping-cart"></span> Products :: View</h1>
              </section>

            <section id="content">
                <div id="actionNavContainer">
                    <ul id="actionNav">
                    <li><a href="/control/products/create">Add New Product</a></li>
                    </ul>
                </div>


    	<div>
                <form name="productsForm" method="post" action="products.php">
        <input type="hidden" name="cid" value="">
      	<table class="detailsList">
      		<tr><th>SKU</th><th>NAME</th><th>DESCRIPTION</th><th>PRICE</th></tr>

      	<?php while ($result = $main_stmt->fetch_object()) : ?>
      		<tr onClick="document.productsForm.pid.value='<?= $result->sku ?>';document.customersForm.submit()">
      		<td><a href="javascript: overlayWindow('product_edit.php?pid=<?= $result->sku ?>', 400, 500)"><?= $result->sku ?></a></td>
      		<td><?= $result->name ?></td><td><?= $result->description ?></td><td><?= $result->price ?></td>
      	<?php endwhile ?>

      	</table>
                </form>
    	</div>




            </section>

          </div><!-- /.col-sm-12 /.col-lg-9 -->