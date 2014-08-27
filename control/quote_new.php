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


if (isset($customer_id)) {
	$customer_stmt = $db_connection->query("SELECT customer_id, company_name, first_name, last_name, address1, address2, city,
								state, postal_code, default_ship_method, phone, billing_email
								FROM customers
								WHERE customer_id = $customer_id
								ORDER BY 2 ASC");	
	$customer_stmt->execute;
	
	$customer_result = $customer_stmt->fetch_object();

	$customer_stmt->close();
	
	$ship_address_stmt = $db_connection->query("SELECT company_name, first_name, last_name, csa.address1, csa.address2, csa.city, csa.state, 
								csa.country, csa.postal_code
								FROM customers AS c
								LEFT JOIN customer_ship_addresses AS csa USING(customer_id)
								WHERE c.customer_id = $customer_id
								AND default_address = 1");
	
	$ship_address_stmt->execute;
	
	$ship_address_result = $ship_address_stmt->fetch_object();
	
	$ship_address_stmt->close();
	
} 

// GET AND SET QUOTE NUMBER
$stmt = $db_connection->query("SELECT IFNULL(MAX(order_number),  0) AS next_order_number FROM quotes");
$result = $stmt->fetch_object();
$quote_number = $result->next_quote_number + 1;

$stmt->close();


// GET LIST OF CUSTOMERS FROM CUSTOMERS TABLE
$customers_stmt = $db_connection->query("SELECT customer_id, company_name, first_name, last_name
								FROM customers
								ORDER BY 2 ASC");	

$customers_stmt->execute;




?>


	<div id="mainContainer">
		<h1>CREATE NEW QUOTE</h1>
		<h2>QUOTE #: <?php echo $quote_number?> DATE: <?php echo date('n/j/Y g:i A') ?></h2>
		
		<div id="mainContainerLeft">
		<form name="customerSelect" method="post" action="quote_new.php">
		<span class="inputLabel">CUSTOMER:</span>
		<select name="cid" onChange="this.form.submit();">
		
<?php 

// IF A CUSTOMER IS ALREADY SELECTED, MAKE IT THE FIRST IN THE LIST
	if (isset($customer_id)) {
		if (isset($customer_result->company_name)) {
			print "<option value=\"$customer_id\">$customer_result->company_name</option>";
		} elseif (isset($customer_result->first_name)) { 
			print "<option value=\"$customer_id\">$customer_result->last_name, $customer_result->first_name</option>";
		}
	}
	
	while ($customers_result = $customers_stmt->fetch_object()) {
		if(isset($customers_result->company_name)) { 
			print "<option value=\"$customers_result->customer_id\">$customers_result->company_name</option>";
		} else {
			print "<option value=\"$customers_result->customer_id\">$customers_result->last_name, $customers_result->first_name</option>";
		}
	}
	
	$customers_stmt->close();
?>
		
	
		</select> <a href="#" onClick="overlayWindow()">New</a>
		</form>
		
<?php

if ($customer_result) {		
	print "<div style=\"padding-top:20px\">
			<div class=\"inputLabel\">BILLING ADDRESS:</div>";
	
	if ($customer_result->company_name) {
		print $customer_result->company_name . '<br />';
	} else {
		print $customer_result->first_name . ' ' . $customer_result->last_name . '<br/>';
	}
	
	print "$customer_result->address1 <br/>
			$customer_result->city, $customer_result->state $customer_result->postal_code <br/>";

	print "<br /> <br />
			<div class=\"inputLabel\">SHIPPING ADDRESS:</div>";
			
	if ($ship_address_result->company_name) {
		print "$ship_address_result->company_name <br />";
	} else {
		print "$ship_address_result->first_name $ship_address_result->last_name <br/>";
	}
	
	print "$ship_address_result->address1 <br/>
		   $ship_address_result->city, $ship_address_result->state $ship_address_result->postal_code <br/>";


	print "<br /> <br />";
			
	print "<div class=\"inputLabel\">SHIP VIA:</div>
			<select name=\"ship_method\">
			<option value=\"$customer_result->default_ship_method\">$customer_result->default_ship_method</option>
			</select>
		</div>";

}
			
?>

		</div>
		<div id="mainContainerRight">
		<form name="quoteCreate" method="post" action="quote_create.php">
		<input type="hidden" name="quote_number" value="<?php echo $quote_number ?>">
		<table>
			<tr><th>Qty</th><th>Product</th><th>Price</th><th>Ext. Price</th></tr>
		<?php 
			for ($i=1;$i<4;$i++) {
				$product_stmt = $db_connection->prepare("SELECT product_id, sku, name, price FROM products");
				$product_stmt->execute();
				$product_stmt->bind_result($pid, $sku, $name, $price);
				
				print "<tr><td><input type=\"text\" name=\"qty_$i\" value=\"\" size=\"3\"></td>";
				print "<td><select name=\"product_id_$i\">";
				
		?>		
		<?php while ($product_stmt->fetch()) : ?>
			<option value="<?php echo "$pid\""; if ($_POST["product_id_$i"] == $pid) echo "selected=\"selected\""; echo ">$sku ( $name )"; ?></option>
				
		<?php endwhile ?>
		
		<?php  		
				print "</select></td>";
			
				print "
					<td><input type=\"text\" name=\"price_$i\" value=\"\" size=\"7\"></td>
					<td><input type=\"text\" name=\"ext_price_$i\" value=\"\" size=\"7\"></td></tr>";
				
				print "<tr><td colspan=\"4\">
						<table>
						<tr><td><textarea onFocus=\"this.value=''\" name=\"personalization_$i\" rows=\"4\" cols=\"30\">PERSONALIZATION</textarea></td>
						<td><textarea onFocus=\"this.value=''\" name=\"production_details_$i\" rows=\"4\" cols=\"30\">PRODUCTION OPTIONS</textarea></td></tr>
						</table>
						<br/></td></tr>";
			}
			
			$product_stmt->close;
		?>
		<tr><td colspan="4" style="text-align:right;border-top:2px solid #C0C0C0">
		<input type="submit" name="submit" value="SAVE"></td></tr>
		</table>
		
		</form>
		</div>
	</div>

</div>

</body>

