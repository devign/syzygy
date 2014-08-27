<?php
$calling_file = basename(__FILE__);
require_once 'init.php';
require_once 'header.php'; 

$db_connection2 = dbConnect();

// GET CUSTOMER ID FROM POST or GET
$customer_id = getCustomerID();


if (isset($action) && $action == 'save') {
	
	saveRecord("customers", array("customer_id", $customer_id));
	
}

if ($customer_id) {
	$main_result = $db_connection->query("SELECT *
						FROM customers AS c
						WHERE customer_id = '$customer_id'");	
		
	$customer_info = $main_result->fetch_object();
	
	$main_result->free();
	

	$side_result = $db_connection->query("SELECT contact_id, contact_type, first_name, last_name, phone, phone_extension, email  
								FROM customer_contacts
								WHERE customer_id = '$customer_id'");
	
	$recent_orders_stmt = $db_connection->prepare("SELECT order_id, order_number, order_date, order_status 
													FROM orders
													WHERE customer_id = " . $customer_id . "
													ORDER BY order_date DESC
													LIMIT 3");
	$recent_orders_stmt->execute();
	
	$recent_orders_stmt->bind_result($oid, $onum, $odate, $ostatus);

	
	$order_details_stmt = $db_connection2->prepare("SELECT quantity, sku 
													FROM order_line_items
													LEFT JOIN products USING(product_id)
													WHERE order_id = ?");
	

	
} 

?>

	<div id="mainContainer">
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

			
			<div id="customerContacts">
				<div class="sectionHead">CUSTOMER CONTACTS</div>

			<?php while ($contact = $side_result->fetch_object()) : ?>
				
					<div class="detailBox">
					<span class="frmLabel">NAME: </span><?= $contact->first_name?> <?= $contact->last_name?><br />
					<span class="frmLabel">TYPE: </span><?= $contact->type?><br />
					<span class="frmLabel">PHONE: </span><?= $contact->phone . ' ' . $contact->phone_ext ?><br />
					<span class="frmLabel">EMAIL: </span><?= $contact->email ?><br />
					</div>
								
			<?php endwhile ?>	
				
			</div>

			<div id="customerOrders">
				<div class="sectionHead">RECENT ORDERS</div>
				<div class="detailBox">
				<table class="recentOrders">
					<th>ORDER #</th><th>DATE</th>
				<?php while ($recent_orders_stmt->fetch()) : ?>
					<tr><td style="border-bottom: 1px solid #C0C0C0"><a href="order_details.php?onum=<?=$onum?>"><?= $onum?></a></td><td style="border-bottom: 1px solid #C0C0C0"><?= $odate?></td></tr>
						<?php $order_details_stmt->bind_param('i', $oid);$order_details_stmt->execute();$order_details_stmt->bind_result($qty, $sku);?>
						<tr><td></td><td>
						<table class="recentOrdersContent">	
							<tr><th>QTY</th><th>SKU</th></tr>
						<?php while ($order_details_stmt->fetch()) : ?>
							<tr><td><?= $qty ?></td><td><?= $sku ?></td></tr>
						<?php endwhile ?>	
						</table>
				<?php endwhile ?>
				</table>
				</div>
			</div>

		</div>


					
		<div id="mainContainerRight">
			<div id="divisionHead">CUSTOMER DETAILS</div>
			<div id="tableContainer">
				<form method="post" action="customer_details.php">
				<input type="hidden" name="action" value="save">
				<input type="hidden" name="cid" value="<?= $customer_id?>">
				<table class="detailsGrid">
				<tr><td class="frmLabel">ACCT #:</td>
				<td><input class="frmTextBox" type="text" name="account_number" value="<?= $customer_info->account_number ?>" size="20"></td>
				<td class="frmLabel">ACCT STATUS:</td>
				<td><input class="frmTextBox" type="text" name="account_status" value="<?= $customer_info->account_status ?>" size="20"></td>
				</tr>
				<tr><td class="frmLabel">TERMS:</td>
				<td><input class="frmTextBox" type="text" name="payment_terms" value="<?= $customer_info->payment_terms ?>" size="20"></td>
				<td class="frmLabel">CREDIT LIMIT:</td>
				<td><input class="frmTextBox" type="text" name="credit_limit" value="<?= $customer_info->credit_limit ?>" size="20"></td>
				</tr>
				<tr><td class="frmLabel">BILLING EMAIL:</td>
				<td><input class="frmTextBox" type="text" name="billing_email" value="<?= $customer_info->billing_email ?>" size="40"></td>
				<td class="frmLabel">TAX EXEMPTION:</td>
				<td><input class="frmTextBox" type="text" name="tax_exemption" value="<?= $customer_info->tax_exemption ?>" size="20"></td>
				</tr>
				
				<tr><td class="frmLabel">COMPANY:</td>
				<td><input class="frmTextBox" type="text" name="company_name" value="<?= $customer_info->company_name ?>" size="40"></td></tr>
				<tr><td class="frmLabel">ADDRESS:</td>
				<td><input class="frmTextBox" type="text" name="address1" value="<?= $customer_info->address1 ?>" size="40"></td></tr>
				<tr><td class="frmLabel">ADDRESS:</td>
				<td><input class="frmTextBox" type="text" name="address2" value="<?= $customer_info->address2 ?>" size="40"></td></tr>
				<tr><td class="frmLabel">CITY:</td>
				<td><input class="frmTextBox" type="text" name="city" value="<?= $customer_info->city ?>" size="40"></td>
				<td class="frmLabel">STATE:</td>
				<td><input class="frmTextBox" type="text" name="state" value="<?= $customer_info->state ?>" size="20"></td></tr>
				<tr><td class="frmLabel">POSTAL CODE:</td>
				<td><input class="frmTextBox" type="text" name="postal_code" value="<?= $customer_info->postal_code ?>" size="40"></td>
				<td class="frmLabel">COUNTRY:</td>
				<td><input class="frmTextBox" type="text" name="country" value="<?= $customer_info->country ?>" size="20"></td></tr>
				<tr><td class="frmLabel">PHONE:</td>
				<td><input class="frmTextBox" type="text" name="phone" value="<?= $customer_info->phone ?>" size="40"></td>
				<td class="frmLabel">EXTEN.:</td>
				<td><input class="frmTextBox" type="text" name="phone_ext" value="<?= $customer_info->phone_ext ?>" size="20"></td></tr>
				<tr><td class="frmLabel">FAX:</td>
				<td><input class="frmTextBox" type="text" name="fax" value="<?= $customer_info->fax ?>" size="40"></td>
				</tr>
				
				<tr><td colspan="4" class="sectionHead">DEFAULT SHIPPING INFO</td></tr>
				
				<tr><td class="frmLabel">ADDRESS:</td>
				<td><input class="frmTextBox" type="text" name="ship_to_address1" value="<?= $customer_info->ship_to_address1 ?>" size="40"></td></tr>
				<tr><td class="frmLabel">ADDRESS:</td>
				<td><input class="frmTextBox" type="text" name="ship_to_address2" value="<?= $customer_info->ship_to_address2 ?>" size="40"></td></tr>
				<tr><td class="frmLabel">CITY:</td>
				<td><input class="frmTextBox" type="text" name="ship_to_city" value="<?= $customer_info->ship_to_city ?>" size="40"></td>
				<td class="frmLabel">STATE:</td>
				<td><input class="frmTextBox" type="text" name="ship_to_state" value="<?= $customer_info->ship_to_state ?>" size="20"></td></tr>
				<tr><td class="frmLabel">POSTAL CODE:</td>
				<td><input class="frmTextBox" type="text" name="ship_to_postal_code" value="<?= $customer_info->ship_to_postal_code ?>" size="40"></td>
				<td class="frmLabel">COUNTRY:</td>
				<td><input class="frmTextBox" type="text" name="ship_to_country" value="<?= $customer_info->ship_to_country ?>" size="20"></td></tr>
				<tr><td class="frmLabel">SHIP METHOD:</td>
				<td><input class="frmTextBox" type="text" name="default_ship_method" value="<?= $customer_info->default_ship_method ?>" size="40"></td>
				<td class="frmLabel">SHIPPER #:</td>
				<td><input class="frmTextBox" type="text" name="shipper_number" value="<?= $customer_info->shipper_number ?>" size="20"></td></tr>
				</table>
				<div style="margin-left:420px;margin-top:10px;">
				<input class="button" type="submit" value="SAVE">
				</div>
				</form>
			</div>
		</div>
	</div>

</div>

</body>

<?php 
	dbDisconnect($db_connection);
?>