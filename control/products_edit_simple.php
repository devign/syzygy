<?php
require_once 'functions.php';
$sku = $_GET['sku'];


/** GET PRODUCT DATA **/
$stmt = $db->prepare("SELECT p.sku, brand_id, name, description, short_description, price, weight, features, 
                        page_title, page_url, keywords
                        FROM products AS p
                        LEFT JOIN product_metadata USING(sku)
                        WHERE p.sku = '$sku'");

$stmt->execute();
$result = $stmt->get_result();
$product_data = $result->fetch_all(MYSQLI_ASSOC);

/**  GET CATEGORIES PRODUCT BELONGS TO **/
$product_categories = getProductCategories($sku);

/**  GET VENDORS PRODUCT BELONGS TO **/
$product_vendors = getProductVendors($sku);

/**  GET VENDORS PRODUCT BELONGS TO **/
$product_stores = getProductStores($sku);

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
              <h1><span class="glyphicon glyphicon-shopping-cart"></span> Products :: Edit</h1>
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

            
<?php if (isset($_POST['formAction']) && $_POST['formAction'] == 'save') : ?>

<?php 
    if (empty($sku)) $sku = prepareData(sanitizeData($_POST['sku']));
    $brand_id = $_POST['brand_id'];
    $name = prepareData(sanitizeData($_POST['name']));
    $description = prepareData(sanitizeData($_POST['description']));
    $short_description = prepareData(sanitizeData($_POST['short_description']));
    $features = prepareData(sanitizeData($_POST['features']));
    $price = $_POST['price'];
    $weight = $_POST['weight'];
    $vendors = $_POST['vendors'];
    $categories = $_POST['category'];
    $stores = $_POST['stores'];
    $page_url = prepareData(sanitizeData($_POST['page_url']));
    $page_title = prepareData(sanitizeData($_POST['page_title']));
    $keywords = prepareData(sanitizeData($_POST['keywords']));
    $product_type = $_POST['product_type'];
    $status = $_POST['status'];
    
    $db->query("UPDATE products
            SET sku = '$sku',
            brand_id = $brand_id,
            name = '$name',
            description = '$description',
            price = '$price',
            weight = '$weight',
            status = $status,
            product_type = '$product_type',
            short_description = '$short_description',
            features = '$features'
            WHERE sku = '$sku'
            ");

            
    $db->query("DELETE FROM product_to_vendor WHERE sku = '$sku'");        
    foreach ($vendors as $k => $v) {
        $db->query("INSERT INTO product_to_vendor(sku,vendor_id) VALUES('$sku',$v)");    
    }  
    
    $db->query("DELETE FROM product_to_store WHERE sku = '$sku'");
    foreach ($stores as $k => $v) {
        $db->query("INSERT INTO product_to_store(sku,store_id) VALUES('$sku',$v)");    
    }       
    
    $db->query("DELETE FROM product_to_category WHERE sku = '$sku'");
    foreach ($categories as $k => $v) {
        $db->query("INSERT INTO product_to_category(sku,category_id) VALUES('$sku',$v)");    
    }      
    
    $db->query("DELETE FROM product_metadata WHERE sku = '$sku'");
    $db->query("INSERT INTO product_metadata(sku,page_url,page_title,keywords) 
            VALUES('$sku','$page_url','$page_title','$keywords')");
    
    
                                                   
?>
   
<div style="padding-top:40px">
	<h3>PRODUCT SUCCESSFULLY SAVED</h3>
</div>


<?php else : ?>

<?php
    $brands = getSetValues($params = array('brand_id', 'brand_name', 'product_brands'));
    
    $vendors  = getSetValues($params = array('vendor_id', 'name', 'vendors'));
    
    $stores  = getSetValues($params = array('store_id', 'store_name', 'stores'));
    
?>
<div>
	<div style="padding-top:40px">
		<form name="productNew" method="post" enctype="multipart/form-data">
		<input type="hidden" name="formAction" value="save">
        <input type="hidden" name="product_type" value="SIMPLE">

        <table>
        <tr><td><label>SKU:</label></td><td><strong><?=$sku?></strong></td></tr>
        <tr><td><label>Status:</label></td>
        <td><select name="status">
        <option value="1">Active</option>
        <option value="0">Inactive</option>
        </select></td></tr>
        <tr><td><label>Brand:</label></td><td><select name="brand_id">
        <?php foreach ($brands as $id => $name) : ?>
            <option value="<?= $id ?>"><?= $name ?></option>
        <?php endforeach; ?>
        </select>  </td></tr>
		
        <tr><td><label>Name:</label></td><td><input type="text" name="name" value="<?=$product_data[0]['name']?>" onBlur="autoSEOInput(this.value, this.form)"/> </td></tr>
        
        <tr><td><label>Description:</label></td><td><textarea name="description" rows="10" cols="80"><?=$product_data[0]['description']?></textarea></td></tr>
        
        <tr><td><label>Short Description:</label></td><td><textarea name="short_description" rows="5" cols="80"><?=$product_data[0]['short_description']?></textarea></td></tr>
        
        <tr><td><label>Features:</label></td><td><textarea name="features" rows="5" cols="40"><?=$product_data[0]['features']?></textarea></td></tr>
        
        <tr><td><label>Price:</label></td><td><input type="text" name="price" value="<?=$product_data[0]['price']?>" /></td></tr>
        
        <tr><td><label>Weight:</label></td><td><input type="text" name="weight" value="<?=$product_data[0]['weight']?>" /></td></tr>

        <tr><td><label>Vendor:</label></td><td><select name="vendors[]" multiple>
        <?php foreach ($vendors as $id => $name) : ?>
            <?php if (in_array($id, $product_vendors)) :?>
                <option value="<?= $id ?>" selected><?= $name ?></option>
            <?php else : ?>
                <option value="<?= $id ?>"><?= $name ?></option>
            <?php endif; ?>
        <?php endforeach; ?>
        </select>  </td></tr>

        <tr><td><label>Store:</label></td><td><select name="stores[]" multiple>
        <?php foreach ($stores as $id => $name) : ?>
            <?php if (in_array($id, $product_stores)) :?>
                <option value="<?= $id ?>" selected><?= $name ?></option>
            <?php else : ?>
                <option value="<?= $id ?>"><?= $name ?></option>
            <?php endif; ?>
        <?php endforeach; ?>
        </select>  </td></tr>
                
        <tr><td><label>Category:</label></td>
        <td><?php printCategoryList($product_categories); ?></td></tr>  
          
        <tr><td><h3>SEO MAGIC</h3></td></tr>
        <tr><td><label>Page Title:</label></td>
        <td><input type="text" name="page_title" value="<?=$product_data[0]['page_title']?>" size="80"/></td></tr>   
        <tr><td><label>Custom URL:</label></td>
        <td><input type="text" name="page_url" value="<?=$product_data[0]['page_url']?>" size="80"/></td></tr>     
        <tr><td><label>Keywords:</label></td>
        <td><textarea name="keywords" rows="5" cols="30"><?=$product_data[0]['keywords']?></textarea></td></tr>
        </table>
        
        <table id="media-magic">
        <tr><td><h3>MEDIA MAGIC</h3></td></tr>
        <tr><td><label>File:</label></td>
        <td><input type="file" name="file[]" /></td></tr>     
        <tr><td><label>Media Type:</label></td>
        <td><input type="text" name="media_type[]" value="" /></td></tr>   

        <tr><td><label>Custom Filename:</label></td>
        <td><input type="text" name="filename[]" value="" /></td></tr>
        
        </table>
        <input type="submit" value="Save">
        </form>
	</div>

</div>

<?php endif ?>

            </section>

          </div><!-- /.col-sm-12 /.col-lg-9 -->