<?php
$calling_file = basename(__FILE__);
require_once 'header.php'; 
require_once 'init.php'; 
$db_connection = dbConnect();

// GET CUSTOMER ID FROM POST or GET
if (isset($_POST['cid'])) {
	$customer_id = $_POST['cid'];
} else {
	$customer_id = $_GET['cid'];
}

$quote_number = $_POST['quote_number'];

$quote_new = $db_connection->query("INSERT INTO quotes(customer_id, quote_number, associate_id, date)
									VALUES($customer_id, $quote_number, $associate_id, NOW())");



?>

	<div id="mainContainer">
		<h1>QUOTE #: <?php echo $quote_number?> DATE: <?php echo date() ?></h1>
		CUSTOMER:<br />
		<select name="cid">
		<?php while ($customer_result = $customer_stmt->fetch_object()) : ?>
			<?php if(isset($customer_result->company_name)) :?> 
				<option value="<?php echo $customer_result->customer_id?>"><?php echo $customer_result->company_name?></option>
			<?php else : ?>
				<option value="<?php echo $customer_result->customer_id?>"><?php echo $customer_result->lname?>, <?php echo $customer_result->fname?></option>
			<?php endif ?>
		<?php endwhile ?>	
		
	
		</select> <a href="javascript:overlayWindow('customer_create.php');">New</a>
		<form name="formQuoteCreate" method="post" action="quote_create.php">
		<table>
			<tr><th>Qty</th><th>Product ID</th><th>Description</th><th>Price</th><th>Ext. Price</th></tr>
		<?php 
			for ($i=1;$i<7;$i++) {
				$product_stmt = $db_connection->prepare("SELECT product_id, sku, name, price FROM products");
				$product_stmt->execute();
				$product_stmt->bind_result($pid, $sku, $name, $price);
				
				print "<tr><td><input type=\"text\" name=\"qty_$i\" value=\"\" size=\"3\"></td>";
				print "<td><select name=\"pid_$i\">";
				
				while ($product_stmt->fetch()) {
					print "<option value=\"$pid\">$sku</option>";
				}
				
				print "</select></td>";
			
				print "<td><input type=\"text\" name=\"name_$i\" value=\"\" size=\"35\"></td>
					<td><input type=\"text\" name=\"price_$i\" value=\"\" size=\"7\"></td>
					<td><input type=\"text\" name=\"extprice_$i\" value=\"\" size=\"7\"></td></tr>";

			}
			
			$product_stmt->close;
		?>
		</table>
		<input type="submit" name="submit" value="SAVE">
		</form>
	</div>

</div>

</body>
