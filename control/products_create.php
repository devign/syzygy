<?php
require_once 'functions.php';

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
              <h1><span class="glyphicon glyphicon-shopping-cart"></span> Products :: Add New</h1>
              </section>

            <section id="content">
                <div id="actionNavContainer">
                    <ul id="actionNav">
                    <li><a href="/control/products/create/simple">Simple</a></li>
                    <li><a href="/control/products/create/variable">Variable</a></li>
                    <li><a href="/control/products/create/customizable">Customizable</a></li>
                    <li><a href="/control/products/create/virtual">Virtual</a></li>
                    </ul>
                </div>

            
<?php if (isset($_POST['frmAction']) && $_POST['frmAction'] == 'insert') : ?>

<?php 

	$sku = insertRecord('products');
	
	$_POST['sku'] = $sku;
	
	
?>


<div style="padding-top:100px">
	<h3>PRODUCT SUCCESSFULLY ADDED</h3>
</div>
<div>
	<button class="button" onCLick="window.opener.location='<?php echo $_POST['caller']?>';window.close()">CLOSE</button>
	
</div>

<?php else : ?>

<div>
	<div style="padding:20px">

	</div>

</div>

<?php endif ?>

            </section>

          </div><!-- /.col-sm-12 /.col-lg-9 -->