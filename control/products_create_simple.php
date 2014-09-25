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

            
<?php if (isset($_POST['formAction']) && $_POST['formAction'] == 'save') : ?>

<?php 
    $sku = prepareData(sanitizeData($_POST['sku']));
    $brand_id = $_POST['brand_id'];
    $name = prepareData(sanitizeData($_POST['name']));
    $description = prepareData(sanitizeData($_POST['description']));
    $short_description = prepareData(sanitizeData($_POST['short_description']));
    $features = prepareData(sanitizeData($_POST['features']));
    $price = $_POST['price'];
    $weight = $_POST['weight'];
    $vendor_id = $_POST['vendor_id'];
    $categories = $_POST['category'];
    $store_id = $_COOKIE['SYZYGY_STOREID'];
    $page_url = prepareData(sanitizeData($_POST['page_url']));
    $page_title = prepareData(sanitizeData($_POST['page_title']));
    $keywords = prepareData(sanitizeData($_POST['keywords']));
    $product_type = $_POST['product_type'];
    
    $db->query("INSERT INTO products(sku,brand_id,name,description,price,weight,status,product_type,short_description,features)
            VALUES('$sku',$brand_id,'$name','$description','$price','$weight',1,'$product_type','$short_description','$features')");

    $db->query("INSERT INTO product_to_vendor(sku,vend_id) VALUES('$sku',$vendor_id)");
    
    $db->query("INSERT INTO product_to_store(sku,store_id) VALUES('$sku',$store_id)");  
    
    foreach ($categories as $k => $v) {
        $db->query("INSERT INTO product_to_category(sku,category_id) VALUES('$sku',$v)");    
    }      
 
    
    $db->query("INSERT INTO product_metadata(sku,page_url,page_title,keywords) 
            VALUES('$sku','$page_url','$page_title','$keywords')");
    
    
    echo "<div style=\"padding-top:30px\">";
    echo "SKU: " . $sku;
    echo "<br>BRAND ID: " . $brand_id;
    echo "<br>NAME: " . $name;
    echo "<br>DESCP: " . $description;
    echo "<br>SHORT DESCP: " . $short_description ."<br/>";
    print_r($features);
    echo "<br>PRICE: " . $price;
    echo "<br>WEIGHT: " . $weight;
    echo "<br>VENDOR ID: " . $vendor_id."<br/>";
    print_r($categories);                                                             
?>
    </div>
<div style="padding-top:100px">
	<h3>PRODUCT SUCCESSFULLY ADDED</h3>
</div>


<?php else : ?>

<?php
    $brands = getSetValues($params = array('brand_id', 'brand_name', 'product_brands'));
    
    $vendors  = getSetValues($params = array('vendor_id', 'name', 'vendors'));
    
    
    
?>
<div>
	<div style="padding-top:40px">
		<form name="productNew" method="post" enctype="multipart/form-data">
		<input type="hidden" name="formAction" value="save">
        <input type="hidden" name="product_type" value="SIMPLE">

        <table>
        <tr><td><label>SKU:</label></td><td><input type="text" name="sku" value="" /></td></tr>
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
		
        <tr><td><label>Name:</label></td><td><input type="text" name="name" value="" onBlur="autoSEOInput(this.value, this.form)"/> </td></tr>
        
        <tr><td><label>Description:</label></td><td><textarea name="description" rows="10" cols="80"></textarea></td></tr>
        
        <tr><td><label>Short Description:</label></td><td><textarea name="short_description" rows="5" cols="80"></textarea></td></tr>
        
        <tr><td><label>Features:</label></td><td><textarea name="features" rows="5" cols="40"></textarea></td></tr>
        
        <tr><td><label>Price:</label></td><td><input type="text" name="price" value="" /></td></tr>
        
        <tr><td><label>Weight:</label></td><td><input type="text" name="weight" value="" /></td></tr>

        <tr><td><label>Vendor:</label></td><td><select name="vendor_id">
        <?php foreach ($vendors as $id => $name) : ?>
        <option value="<?= $id ?>"><?= $name ?></option>
        <?php endforeach; ?>
        </select>  </td></tr>
        
        <tr><td><label>Category:</label></td>
        <td><?php printCategoryList(); ?></td></tr>  
          
        <tr><td><h3>SEO MAGIC</h3></td></tr>
        <tr><td><label>Page Title:</label></td>
        <td><input type="text" name="page_title" value="" size="80"/></td></tr>   
        <tr><td><label>Custom URL:</label></td>
        <td><input type="text" name="page_url" value="" size="80"/></td></tr>     
        <tr><td><label>Keywords:</label></td>
        <td><textarea name="keywords" rows="5" cols="30"></textarea></td></tr>
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