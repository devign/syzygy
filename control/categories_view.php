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

              <div id="searchCriteria" style="float:right;">
              <form name="searchForm" action="customers.php" method="post">
              <input type="hidden" name="action" value="search">
              <span class="inputLabel">SEARCH: <input type="text" name="search_value" value="" size="20">

              <button class="button" onClick="searchForm.submit();">GO!</button>

              </form>
              </div>
              <h1><span class="glyphicon glyphicon-shopping-cart"></span> Product Categories</h1>
              </section>

            <section id="content">
                <div id="actionNavContainer">
                    <ul id="actionNav">
                    <li><a href="/control/categories/create">Add New Category</a></li>
                    </ul>
                </div>
            

    	        <div style="padding-top:40px">
      	            <?php printCategoryList(); ?>
    	        </div>

            </section>

        </div><!-- /.col-sm-12 /.col-lg-9 -->