<?php


if (isset($action) && $action == 'search') {

	$search_on = $_POST['search_value'];

	$main_query = "SELECT sku, name, description, price FROM products";

	$main_stmt = $db->query($main_query);


} else {

	$main_stmt = $db->query("SELECT * FROM product_categories");

}



?>
          <div class="col-xs-12 col-md-9">
             
            <section id="page-header">

              <h1><span class="glyphicon glyphicon-home"></span> Product Categories</h1>

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

        <div>
            <a href="/control/categories/create">Add New Category</a>
        </div>
    </div>

    <div id="mainContainerRight">

    	<form name="productsForm" method="post" action="products.php">
    	<input type="hidden" name="cid" value="">
    	<div style="width:590px;overflow:auto;height:560px">
      	<table class="detailsList">
      		<tr><th>ID</th><th>NAME</th><th>DESCRIPTION</th><th>IMAGE</th></tr>

      	<?php while ($result = $main_stmt->fetch_object()) : ?>
      		<tr onClick="document.productsForm.pid.value='<?= $result->category_id ?>';document.customersForm.submit()">
      		<td><a href="javascript: overlayWindow('product_edit.php?pid=<?= $result->category_id ?>', 400, 500)"><?= $result->category_id ?></a></td>
      		<td><?= $result->category_name ?></td><td><?= $result->category_descp ?></td><td><?= $result->category_image ?></td>
      	<?php endwhile ?>

      	</table>
    	</div>
    	</form>
    </div>


            </section>

          </div><!-- /.col-sm-12 /.col-lg-9 -->