<?php
$calling_file = basename(__FILE__);
require_once 'init.php';
require_once 'header.php';

$db_connection2 = dbConnect();

/*
 * GET ORDER NUM FROM POST or GET
 */
$order_number = getValue('onum');

/*
 * GET ORDER ID FROM DB
 */
$order_id = getOrderID($order_number);

/*
 * GET ORDER TYPE FROM POST or GET
 */
$order_type = getValue('type');

/*
 * GET SHIP TO ADDRESS FROM POST or GET
 */
$ship_address_id = getValue('ship_address_id');


/*
 * GET CUSTOMER ID FROM orders TABLE
 */
$result = $db_connection->query("SELECT customer_id FROM orders WHERE order_number = " . $order_number);

$temp = $result->fetch_object();

$customer_id = $temp->customer_id;

/*
 * IF CUSTOMER IS ALREADY SET THEN GET CUSTOMER INFO FROM DATABASE
 */
if (isset($customer_id)) {

  $customer_result = $db_connection->query("SELECT customer_id, account_number, company_name, first_name, last_name, address1,
								address2, city, state, postal_code, default_ship_method, phone, billing_email
								FROM customers
								WHERE customer_id = $customer_id
								ORDER BY 2 ASC");

  $customer_info = $customer_result->fetch_object();

  $customer_result->close();

	/*
	 * ADD NEW SHIP TO ADDRESS TO DATABASE IF NEW SHIP ADDRESS ENTERED
	 */
  if (isset($POST['new_ship_address']) && $_POST['new_ship_address'] == 1) {
		$stmt = $db_connection->prepare("SELECT IFNULL(MAX(ship_address_id), 0) as next_id FROM customer_ship_addresses");

		$stmt->execute();
		$result = $stmt->fetch_object();
		$ship_address_id = $result->next_id + 1;

		$stmt->close();

		$stmt = $db_connection->prepare("INSERT INTO customer_ship_address(ship_address_id, customer_id, company_name first_name,
							last_name, address1, address2, city, state, postal_code, country)
							VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

		$stmt->bind_param("iisssssssss", $ship_address_id, $customer_id, $_POST['ship_to_company'], $_POST['ship_to_fname'], $_POST['ship_to_lname'],
							$_POST['ship_to_address1'], $_POST['ship_to_address2'], $_POST['ship_to_city'], $_POST['ship_to_state'],
							$_POST['ship_to_postal_code'], $_POST['ship_to_country']);

		$stmt->execute();

		$stmt->close();


	}

	/*
	 * GET SHIP TO ADDRESS FOR THIS ORDER
	 */
	if (isset($ship_address_id)) {

		$ship_address_sql = "SELECT ship_address_id, company_name, first_name, last_name, address1, address2, city, state,
							country, postal_code
							FROM customer_ship_addresses
							WHERE customer_id = $customer_id
							AND ship_address_id = $ship_address_id";

	} else {

		$ship_address_sql = "SELECT ship_address_id, company_name, first_name, last_name, address1, address2, city, state,
							country, postal_code
							FROM customer_ship_addresses
							WHERE customer_id = $customer_id
							AND ship_address_id = 1";
	}


	$ship_address_stmt = $db_connection->prepare($ship_address_sql);

	$ship_address_stmt->execute();

	$ship_address_result = $ship_address_stmt->get_result();

	$ship_address = $ship_address_result->fetch_object();

	$ship_address_stmt->close();


	/*
	 * GET SHIPPING METHODS FOR SELECTION BOX
	*/
	$ship_methods = getColumnSetValues('customers', 'default_ship_method');
}

/*
 * IF SAVE ORDER FLAG IS SET, SAVE ORDER THEN REDIRECT TO ORDER DETAILS
 */
if (isset($_POST['saveOrder']) && $_POST['saveOrder'] == 1) {

  $subtotal = updateOrderItems($order_id);

  if ($_POST['ship_method'] == 'PICKUP') {
    $result = $db_connection->query("SELECT state FROM stores WHERE store_id = ". $_COOKIE['HWO_STOREID']);
    $pickup = $result->fetch_object();
    $salestax = calcSalesTax($subtotal, $pickup->state);
    print "|".$pickup->state."|";
  } else {
    $salestax = calcSalesTax($subtotal, $ship_address->state);
  }

  $order_discount = 0;

  $order_total = $subtotal + $_POST['ship_cost'] + $salestax;

// UPDATE ORDER TOTALS IN DB
  $stmt = $db_connection->prepare("UPDATE orders SET order_subtotal = ?,
                  						order_ship_total = ?,
									order_sales_tax = ?,
                                                      order_date_promised = ?,
                                                      ship_method = ?
									WHERE order_id = " . $order_id);

  $stmt->bind_param('dddss', $subtotal, $_POST['ship_cost'], $salestax, $_POST['order_date_promised'], $_POST['ship_method']);
  $stmt->execute();
  $stmt->close();

  header("Location: order_details.php?onum=" . $order_number);

}


// GET ORDER ITEMS
$items_stmt = $db_connection->prepare("SELECT p.product_id AS pid, line_no, oli.quantity AS qty, personalization, production_details, p.description AS descp, oli.price AS price, oli.ext_price AS ext_price
									FROM products AS p
									LEFT JOIN order_line_items AS oli USING(product_id)
									LEFT JOIN orders AS o USING(order_id)
									WHERE o.order_number = $order_number");

$items_stmt->execute();

$items_result = $items_stmt->get_result();


?>

	<div id="mainContainer">
		<h1>EDIT ORDER</h1>
		<h2>ORDER#: <?= $order_number?> DATE: <?= $date_time->format('n/d/Y h:m A')?></h2>

		<div id="mainContainerLeft">
		<form name="orderEdit" method="post">
		<input type="hidden" name="saveOrder" value="0">
		<input type="hidden" name="order_number" value="<?= $order_number?>">


<?php
		// IF A CUSTOMER IS ALREADY SELECTED, MAKE IT THE FIRST IN THE LIST
	if (isset($customer_id)) {
		if (isset($customer_info->company_name)) {
			print "<h3>$customer_info->company_name</h3>";
			print "<input type=\"hidden\" name=\"cid\" value=\"$customer_id\">";
		} elseif (isset($customer_info->first_name)) {
			print "<h3>$customer_info->last_name, $customer_info->first_name</h3>";
			print "<input type=\"hidden\" name=\"cid\" value=\"$customer_id\">";
		}
	} else {
		print "<span class=\"inputLabel\">CUSTOMER:</span> <select name=\"cid\" onChange=\"this.form.submit();\"><option>SELECT CUSTOMER...</option>";

		/*
		 *  GET LIST OF CUSTOMERS FROM CUSTOMERS TABLE
		*/
		$stmt = $db_connection->prepare("SELECT customer_id, company_name, first_name, last_name
								FROM customers
								ORDER BY 2 ASC");

		$stmt->execute();

		$results = $stmt->get_result();

		$option_name = '';
		while ($customers = $results->fetch_object()) {
			if(isset($customers->company_name)) {
				$option_name = $customers->company_name;
			} else {
				$option_name = $customers->last_name . ', ' . $customers->first_name;
			}


			if (strlen($option_name) > 25) {
				$option_name = substr($option_name, 0, 24);
				$option_name .= '...';
			}

			print "<option value=\"$customers->customer_id\">$option_name</option>";
		}

		print "</select> <a class=\"miniButton\" href=\"#\" onClick=\"overlayWindow('customer_new.php?caller=order_new.php', '480', '760');return false;\">New</a>";

		$stmt->close();
	}


?>

<?php if (isset($customer_info)) : ?>

	<div style="padding-top:20px">
			<div class="inputLabel">BILLING ADDRESS:</div>

	<?= ($customer_info->company_name ? $customer_info->company_name : $customer_result->info_name . ' ' . $customer_info->last_name)?><br/>

	<?= $customer_info->address1?><br/>
	<?= $customer_info->city . " " . $customer_info->state . " " . $customer_info->postal_code?><br/>

			<br /> <br />
			<div><span class="inputLabel">SHIPPING ADDRESS:</span>
			<input type="hidden" name="ship_address_id" value="<?= ($ship_address_id ? isset($ship_address_id) : $ship_address->ship_address_id) ?>">
			<a class="miniButton" href="#" onClick="overlayWindow('select_ship_address.php?cid=<?= $customer_id?>', 400, 600)">Change</a></div>

	<?= ($ship_address->company_name ? $ship_address->company_name : $ship_address->first_name . ' ' . $ship_address->last_name)?><br/>

	<?= $ship_address->address1?><br/>
	<?= $ship_address->city . " " . $ship_address->state . " " . $ship_address->postal_code?><br/>


			<br /> <br />

			<div class="inputLabel">SHIP VIA:</div>
			<select name="ship_method">
		      <option value="<?= (isset($_POST['ship_method']) ? $_POST['ship_method'] : $customer_info->default_ship_method) ?>">
                  <?= (isset($_POST['ship_method']) ? $_POST['ship_method'] : $customer_info->default_ship_method) ?></option>

	<?php foreach ($ship_methods as $sm) : ?>
			<option value="<?= $sm?>"><?= $sm?></option>

	<?php endforeach ?>

			</select>
			Amount: $<input type="text" name="ship_cost" value="<?= (isset($_POST['ship_cost']) ? $_POST['ship_cost'] : '') ?>" size="10">
			<br /> <br />

			<div class="inputLabel">DATE PROMISED:</div>

			<input class="datepicker" id="datepicker" type="text" name="order_date_promised" value="<?= (isset($_POST['order_date_promised']) ? $_POST['order_date_promised'] : '') ?>" size="20">
			</div>

			<script>
				$("#datepicker").datepicker({ dateFormat: "yy-mm-dd" });
			</script>


<?php endif ?>

  </div>

  <div id="mainContainerRight">
    <div>
	<span class="inputLabel">ORDER TYPE:</span> <input type="radio" name="order_type" value="QUOTE" <?php if ($order_type == 'QUOTE') { echo "checked=\"checked\""; }?>> Quote
	<input type="radio" name="order_type" value="ORDER" <?php if ($order_type == 'ORDER') { echo "checked=\"checked\""; }?>>	Order
	</div>
	<div class="rightScroll">
	  <table class="inputArea">
	  <tr><th>Qty</th><th>Product</th><th>Price</th><th>Ext. Price</th></tr>
    <?php $count = 1;
	    while ($result = $items_result->fetch_object()) {

		  $product_stmt = $db_connection->prepare("SELECT product_id, sku, name, price FROM products");
		  $product_stmt->execute();
		  $product_stmt->bind_result($pid, $sku, $name, $price);
		  $entered_price = 0;

    ?>

    	  <tr><td><input type="text" style="text-align:center" name="<?= "qty_$count"?>" value="<?php if ($_POST["qty_$count"]) { echo $_POST["qty_$count"]; } else { echo $result->qty; }?>" size="3" onChange="this.form.submit();"></td>
		  <td><select name="<?= 'product_id_' . $count?>" onChange="this.form.submit();">
		  <option value="<?=$result->pid?>"><?= $result->descp ?></option>

        <?php while ($product_stmt->fetch()) : ?>
	  <?php
	      $option_text = $sku . ' ( ' . $name . ' ) ';

		if (strlen($option_text) > 40) {
		  $option_text = substr($option_text, 0, 38);
		  $option_text .= '...';
		}

	  ?>
	  <option value="<?= $pid?>" <?php if ($_POST['product_id_' . $i] == $pid) :?> selected="selected"<?php endif?>><?= $option_text ?></option>

	  <?php
	      if (isset($_POST['product_id_' . $i]) &&  $_POST['product_id_' . $i] == $pid) {
		  $entered_price = $price;
		}

	  ?>

	  <?php endwhile ?>

	    </select></td>

        <?php
	      print "
			<td><input style=\"text-align:right\" type=\"text\" name=\"price_$count\" value=\"$result->price\" size=\"7\" onBlur=\"this.form.submit();\"></td>
			<td><input style=\"text-align:right\" type=\"text\" name=\"ext_price_$count\" value=\"$result->ext_price\" size=\"7\"></td></tr>";

		print "<tr><td colspan=\"4\">
						<table>
						<tr><td><textarea onFocus=\"if (this.value == 'PERSONALIZATION') this.value='';\" name=\"personalization_$count\" rows=\"4\" cols=\"30\">";

	      if ($_POST["personalization_$count"]) {
              print fixLineEndings($_POST["personalization_$count"]);
		} else {
		  print fixLineEndings($result->personalization);
		}

		print "</textarea></td>
					<td><textarea onFocus=\"if (this.value == 'PRODUCTION OPTIONS') this.value='';\" name=\"production_details_$count\" rows=\"4\" cols=\"30\">";

		if ($_POST["production_details_$count"]) {
		  print fixLineEndings($_POST["production_details_$count"]);
		} else {
		  print fixLineEndings($result->production_options);
		}

		print "</textarea></td></tr>
						</table>
						</td></tr>";
	      $count++;

        } // END WHILE LOOP
            $count--;
		for ($i=1;$i<4;$i++) {
              $product_stmt = $db_connection->prepare("SELECT product_id, sku, name, price FROM products");
		  $product_stmt->execute();
		  $product_stmt->bind_result($pid, $sku, $name, $price);
		  $entered_price = 0;
		  $i = $i + $count;
	  ?>

		  <tr><td><input type="text" style="text-align:center" name="<?= "qty_$i"?>" value="<?php if ($_POST["qty_$i"]) { echo $_POST["qty_$i"]; } else { echo "0"; }?>" size="3" onChange="this.form.submit();"></td>
		  <td><select name="<?= 'product_id_' . $i?>" onChange="this.form.submit();">
		  <option>CHOOSE PRODUCT...</option>


          <?php while ($product_stmt->fetch()) : ?>
          <?php
	              $option_text = $sku . ' ( ' . $name . ' ) ';
			  if (strlen($option_text) > 40) {
			    $option_text = substr($option_text, 0, 38);
			    $option_text .= '...';
			  }

	   ?>
	    <option value="<?= $pid?>" <?php if ($_POST['product_id_' . $i] == $pid) :?> selected="selected"<?php endif?>><?= $option_text ?></option>

	       <?php if (isset($_POST['product_id_' . $i]) &&  $_POST['product_id_' . $i] == $pid) {
		           $entered_price = $price;
		       }  ?>

          <?php endwhile ?>

	        </select></td>

	    <?php if ($entered_price == 0 && isset($_POST["price_$i"]) && $_POST["price_$i"] != 0) {

                    $entered_price = sprintf("%01.2f", $_POST["price_$i"]);
			  $extprice = sprintf("%01.2f", $_POST["qty_$i"] * $entered_price);

                } elseif (isset($entered_price)) {

                    $entered_price = sprintf("%01.2f", $entered_price);
		        $extprice = sprintf("%01.2f", $_POST["qty_$i"] * $entered_price);

                } else {

                    $entered_price = 0;
			  $extprice = 0;
	          }

	          print "
			  <td><input style=\"text-align:right\" type=\"text\" name=\"price_$i\" value=\"$entered_price\" size=\"7\" onBlur=\"this.form.submit();\"></td>
			  <td><input style=\"text-align:right\" type=\"text\" name=\"ext_price_$i\" value=\"$extprice\" size=\"7\"></td></tr>";

	          print "<tr><td colspan=\"4\">
						<table>
						<tr><td><textarea onFocus=\"if (this.value == 'PERSONALIZATION') this.value='';\" name=\"personalization_$i\" rows=\"4\" cols=\"30\">";

		    if ($_POST["personalization_$i"]) {
		      print $_POST["personalization_$i"];
		    } else {
			print "PERSONALIZATION";
		    }

	          print "</textarea></td>
						<td><textarea onFocus=\"if (this.value == 'PRODUCTION OPTIONS') this.value='';\" name=\"production_details_$i\" rows=\"4\" cols=\"30\">";

		    if ($_POST["production_details_$i"]) {
		      print $_POST["production_details_$i"];
		    } else {
			print "PRODUCTION OPTIONS";
		    }
		    print "</textarea></td></tr>
						</table>
						<br/></td></tr>";

		} // END FOR LOOP


		  $product_stmt->close();
	      ?>

		</table>
		</div>
		<div style="margin-left:470px;margin-top:10px;">
		<input class="button" type="submit" name="saveButton" value="SAVE ORDER" onClick="this.form.saveOrder.value='1';this.form.submit();"></div>
		</form>
		</div>
	</div> <!-- close mainContainer -->

</div> <!-- close pageContainer -->

</body>

<?php

	dbDisconnect($db_connection);

?>