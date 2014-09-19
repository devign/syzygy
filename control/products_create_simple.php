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
                    <li><strong>Simple</strong></li>
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

<?php
    $brands = getSetValues($params = array('brand_id', 'brand_name', 'product_brands'));
    
    $vendors  = getSetValues($params = array('vendor_id', 'name', 'vendors'));
    
?>
<div>
	<div style="padding-top:40px">
		<form name="productNew" method="post">
		<input type="hidden" name="frmAction" value="save">
        <input type="hidden" name="product_type" value="SIMPLE">

        <table>
        <tr><td><label>SKU:</label></td><td><input type="text" name="sku" value="" /></td></tr>
        
        <tr><td><label>Brand:</label></td><td><select name="brand_id">
        <?php foreach ($brands as $id => $name) : ?>
        <option value="<?= $id ?>"><?= $name ?></option>
        <?php endforeach; ?>
        </select>  </td></tr>
		
        <tr><td><label>Name:</label></td><td><input type="text" name="name" value="" /> </td></tr>
        
        <tr><td><label>Description:</label></td><td><textarea name="description" rows="10" cols="80"></textarea></td></tr>
        
        <tr><td><label>Short Description:</label></td><td><textarea name="short_description" rows="5" cols="80"></textarea></td></tr>
        
        <tr><td><label>Price:</label></td><td><input type="text" name="price" value="" /></td></tr>
        
        <tr><td><label>Weight:</label></td><td><input type="text" name="weight" value="" /></td></tr>

        <tr><td><label>Vendor:</label></td><td><select name="vendor_id">
        <?php foreach ($vendors as $id => $name) : ?>
        <option value="<?= $id ?>"><?= $name ?></option>
        <?php endforeach; ?>
        </select>  </td></tr>
                
        </table>
        
		</form>
	</div>

</div>

<?php endif ?>

            </section>

          </div><!-- /.col-sm-12 /.col-lg-9 -->