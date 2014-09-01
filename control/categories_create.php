<?php
require_once 'functions.php';

/**
* GET ROOT CATEGORIES
*/
$rootCatStmt = $db->query("SELECT category_id, category_name FROM product_categories WHERE root_category = 1");


?>

          <div class="col-xs-12 col-md-9">
             
            <section id="page-header">

              <h1><span class="glyphicon glyphicon-home"></span> Product Categories :: Create New</h1>

            </section>

            <section id="content">

<?php if (isset($_POST['save']) && $_POST['save'] == 'y') : ?>

<?php 

	$product_id = insertRecord('products');
	
	$_POST['product_id'] = $product_id;
	
	
?>


<div style="padding-top:100px">
	<h3>CATEGORY SUCCESSFULLY ADDED</h3>
</div>

<?php else : ?>

<div>
	<div style="padding:20px">
		<h3>ENTER CATEGORY INFORMATION</h3>
		<form name="categoryNew" method="post" enctype="multipart/form-data">
		<input type="hidden" name="save" value="y">
        
        <table>
        <tr><td>Root Category:</td>
        <td>
        <select name="root_category">
        <option value="0">No</option>
        <option value="1">Yes</option>
        </select>
        </td>
        </tr>
        <tr><td>Parent Category:</td>
        <td>
        <select name="parent_category_id">
<?php while ($result = $rootCatStmt->fetch_object()): ?>
        <option value="<?=$result->category_id?>"><?=$result->category_name?></option>               
 
<?php endwhile; ?>
        </select>
        </td>
        </tr>
        <tr><td>Category Name:</td>
        <td>
        <input type="text" name="category_name" value="" size="30" />
        </td>
        </tr>
        <tr><td>Category Description:</td>
        <td>
        <textarea cols="80" rows="10" name="category_description"></textarea>
        </td>
        </tr>
        <tr><td>Category Image:</td>
        <td>
        <input type="file" name="category_image" />
        </td>
        </tr>
        </table>
		
		</form>
	</div>

</div>

<?php endif ?>

            </section>

          </div><!-- /.col-sm-12 /.col-lg-9 -->