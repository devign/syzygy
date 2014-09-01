<?php


/*
 * CALCULATE ORDER SALES TAX
 * RECEIVES: sub total
 * RETURNS: sales tax
 */
function calcSalesTax($subtotal, $region) {
  global $db, $sales_tax_regions;

  foreach ($sales_tax_regions as $str) {
    if (in_array($region, $str)) {
      $result = $db_connection->query("SELECT sales_tax_rate FROM stores WHERE store_id = " . $_COOKIE['HWO_STOREID']);
      $store = $result->fetch_object();
      $result->close();
      $sales_tax = sprintf("%2f", $store->sales_tax_rate * $subtotal);
    } else {
      $sales_tax = 0;
    }
  }
  return $sales_tax;

}


/*
 * CALCULATE ORDER SHIPPING TOTAL
 * RECEIVES: ship method, ship weight ship to postal code
 * RETURNS: shipping cost
 */
function calcShipping($ship_method, $ship_weight, $postal_code) {

	return 10;

}

/*
 * CREATE AN EDIT FORM BASED ON A DATABASE TABLE
*/
function createEditForm($table_name, $key = array(), $hide_fields = array()) {
	global $db;
	global $config;

	$db2 = new Database();

	$result = $db2->query("SELECT * FROM " . $table_name . " WHERE " . $key[0] . "=" . $key[1]);

	$form_data = $result->fetch_all();

	$stmt = $db->prepare("SHOW FULL COLUMNS FROM $table_name");

	$stmt->execute();

	$stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8, $col9);

	print "<table class=\"editFormTable\">";
	while ($stmt->fetch()) {

		if (!in_array($col1, $hide_fields)) {

			$output = "<tr>";
			$required = 0;

			if ($col5 != 'PRI' && $col5 != 'MUL' && $col7 != 'auto_increment') {
				if ($col4 == 'NO') {
					$required = 1;
				}

				if (preg_match('/^set/', $col2)) {
					$set_values = getColumnSetValues($col2);
					$label = ucwords(preg_replace('/_/', ' ', $col1));
					$output .= "<td class=\"frmLabel\">";
					$output .= $label . ':</td>';
					$output .= "<td><select class=\"frmTextBox\" name=\"$col1\">";
					foreach ($set_values as $val) {
						$output .= "<option value=\"$val\">$val</option>";
					}
					$output .= "</select></td>";

				} elseif (preg_match('/text/', $col2)) {
					$label = ucwords(preg_replace('/_/', ' ', $col1));
					$output .= "<td class=\"frmLabel\">";
					$output .= $label . ':</td>';
					$output .= "<td><textarea autocomplete=\"off\" name=\"$col1\" value=\"$form_data[$col1]\" rows=\"10\" cols=\"50\"></textarea></td>";

				} elseif ((preg_match('/tinyint/', $col2)) && $col9 === 'YES/NO' ) {
					$label = ucwords(preg_replace('/_/', ' ', $col1));
					$output .= "<td class=\"frmLabel\">";
					$output .= $label . ':</td>';
					if ($col6 == 0) {
						$output .= "<td><select name=\"$col1\"><option value=\"0\">NO</option><option value=\"1\">YES</option></select></td>";
					} else {
						$output .= "<td><select name=\"$col1\"><option value=\"1\">YES</option><option value=\"0\">NO</option></select></td>";
					}
				} else {
					$label = ucwords(preg_replace('/_/', ' ', $col1));
					$output .= "<td class=\"frmLabel\">";
					$output .= $label . ':</td>';
					$output .= "<td><input autocomplete=\"off\" type=\"text\" name=\"$col1\" value=\"$form_data[$col1]\" value=\"$col5\" size=\"30\"></td>";
				}

			} elseif ($col5 == 'MUL') {
				$result = $db2->query("SELECT REFERENCED_TABLE_NAME, REFERENCED_COLUMN_NAME
												FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE
												WHERE TABLE_SCHEMA = '" . $config['db'] . "'
												AND TABLE_NAME = '" . $table_name . "'
												AND COLUMN_NAME = '" . $col1 . "'");
				$ref_data = $result->fetch_object();

				$result = $db2->query("SHOW FULL COLUMNS FROM suppliers
												WHERE Comment = 'DISPLAY_ON_SELECT'");
				$display_field = $result->fetch_object();

				$stmt2= $db2->prepare("SELECT " . $ref_data->REFERENCED_COLUMN_NAME .", " . $display_field->Field .
												" FROM " . $ref_data->REFERENCED_TABLE_NAME);

				$stmt2->execute();
				$stmt2->bind_result($id, $name);

				if (preg_match('/_id$/', $col1) === 1) {
					$label = ucwords(preg_replace('/_id$/', '', $col1));
				} else {
					$label = ucwords(preg_replace('/_/', ' ', $col1));
				}

				$output .= "<td class=\"frmLabel\">";
				$output .= $label . ':</td>';

				$output .= "<td><select name=\"$col1\">";

				while ($stmt2->fetch()) {
					$output .= "<option value=\"$id\">$name</option>";
				}

				$output .= "</select><a class=\"miniButton\" href=\"javascript:overlayWindow('supplier_new.php', '480', '600')\">New</a></td>";

				$stmt2->close();
			} elseif ($col5 == 'PRI' && preg_match('/^FK_/', $col9) ) {
                        list($gar, $fk_table) = explode('_', $col9);

                        $result = $db2->query("SHOW COLUMNS FROM ".  $fk_table);
                        $cols = $result->fetch_object();

                        $stmt2 = $db2->prepare("SELECT store_id, store_name, city FROM " . $fk_table);

                        $stmt2->execute();
                        $stmt2->bind_result($id, $name, $city);

				if (preg_match('/_id$/', $cols->Field) === 1) {
					$label = ucwords(preg_replace('/_id$/', '', $cols->Field));
				} else {
					$label = ucwords(preg_replace('/_/', ' ', $cols->Field));
				}

                        $output .= "<td class=\"frmLabel\">";
    			        $output .= $label . ':</td>';
                        $output .= "<td><select name=\"$cols->Field\">";

                        while ($stmt2->fetch()) {
                            $output .= "<option value=\"$id\">$name - $city</option>";

                        }

                        $output .= "</select></td>";

                        $stmt2->close();
			}

			$output .= "</tr>";
			print $output;

		}

	}

	print "<tr><td style=\"text-align:center\" colspan=\"2\"><input type=\"submit\" class=\"button\" value=\"SAVE\">
			<button type=\"button\" name=\"btnCancel\" class=\"button\" onClick=\"window.close();\">CANCEL</button></a></td></tr>";
	$stmt->close();

}
/*
 * CREATE AN INPUT FORM BASED ON A DATABASE TABLE
*/
function createInputForm($table_name, $hide_fields = array()) {
	global $db;
	global $config;

	$db2 = new Database();

	$stmt = $db->prepare("SHOW FULL COLUMNS FROM $table_name");

	$stmt->execute();

	$stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8, $col9);

	print "<table class=\"inputFormTable\">";
	while ($stmt->fetch()) {

		if (!in_array($col1, $hide_fields)) {

			$output = "<tr>";
			$required = 0;

			if ($col5 != 'PRI' && $col5 != 'MUL' && $col7 != 'auto_increment') {
				if ($col4 == 'NO') {
					$required = 1;
				}

				if (preg_match('/^set/', $col2)) {
					$set_values = getColumnSetValues($col2);
					$label = ucwords(preg_replace('/_/', ' ', $col1));
					$output .= "<td class=\"frmLabel\">";
					$output .= $label . ':</td>';
					$output .= "<td><select class=\"frmTextBox\" name=\"$col1\">";
					foreach ($set_values as $val) {
						$output .= "<option value=\"$val\">$val</option>";
					}
					$output .= "</select></td>";

				} elseif (preg_match('/text/', $col2)) {
					$label = ucwords(preg_replace('/_/', ' ', $col1));
					$output .= "<td class=\"frmLabel\">";
					$output .= $label . ':</td>';
					$output .= "<td><textarea autocomplete=\"off\" name=\"$col1\" rows=\"10\" cols=\"50\"></textarea></td>";

				} elseif ((preg_match('/tinyint/', $col2)) && $col9 === 'YES/NO' ) {
					$label = ucwords(preg_replace('/_/', ' ', $col1));
					$output .= "<td class=\"frmLabel\">";
					$output .= $label . ':</td>';
					if ($col6 == 0) {
						$output .= "<td><select name=\"$col1\"><option value=\"0\">NO</option><option value=\"1\">YES</option></select></td>";
					} else {
						$output .= "<td><select name=\"$col1\"><option value=\"1\">YES</option><option value=\"0\">NO</option></select></td>";
					}
				} elseif (preg_match('/blob/', $col2)) {
					$label = ucwords(preg_replace('/_/', ' ', $col1));
					$output .= "<td class=\"frmLabel\">";
					$output .= $label . ':</td>';
					$output .= "<td><input type=\"file\" autocomplete=\"off\" name=\"$col1\"></td>";

				} else {
					$label = ucwords(preg_replace('/_/', ' ', $col1));
					$output .= "<td class=\"frmLabel\">";
					$output .= $label . ':</td>';
					$output .= "<td><input autocomplete=\"off\" type=\"text\" name=\"$col1\" value=\"$col5\" size=\"30\"></td>";
				}

			} elseif ($col5 == 'MUL') {
				$result = $db2->query("SELECT REFERENCED_TABLE_NAME, REFERENCED_COLUMN_NAME
												FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE
												WHERE TABLE_SCHEMA = '" . $config['db'] . "'
												AND TABLE_NAME = '" . $table_name . "'
												AND COLUMN_NAME = '" . $col1 . "'");
				$ref_data = $result->fetch_object();

				$result = $db2->query("SHOW FULL COLUMNS FROM suppliers
												WHERE Comment = 'DISPLAY_ON_SELECT'");
				$display_field = $result->fetch_object();

				$stmt2= $db2->prepare("SELECT " . $ref_data->REFERENCED_COLUMN_NAME .", " . $display_field->Field .
												" FROM " . $ref_data->REFERENCED_TABLE_NAME);

				$stmt2->execute();
				$stmt2->bind_result($id, $name);

				if (preg_match('/_id$/', $col1) === 1) {
					$label = ucwords(preg_replace('/_id$/', '', $col1));
				} else {
					$label = ucwords(preg_replace('/_/', ' ', $col1));
				}

				$output .= "<td class=\"frmLabel\">";
				$output .= $label . ':</td>';

				$output .= "<td><select name=\"$col1\">";

				while ($stmt2->fetch()) {
					$output .= "<option value=\"$id\">$name</option>";
				}

				$output .= "</select><a class=\"miniButton\" href=\"javascript:overlayWindow('supplier_new.php', '480', '600')\">New</a></td>";

				$stmt2->close();
			} elseif ($col5 == 'PRI' && preg_match('/^FK_/', $col9) ) {
                        list($gar, $fk_table) = explode('_', $col9);

                        $result = $db2->query("SHOW COLUMNS FROM ".  $fk_table);
                        $cols = $result->fetch_object();

                        $stmt2 = $db2->prepare("SELECT store_id, store_name, city FROM " . $fk_table);

                        $stmt2->execute();
                        $stmt2->bind_result($id, $name, $city);

				if (preg_match('/_id$/', $cols->Field) === 1) {
					$label = ucwords(preg_replace('/_id$/', '', $cols->Field));
				} else {
					$label = ucwords(preg_replace('/_/', ' ', $cols->Field));
				}

                        $output .= "<td class=\"frmLabel\">";
    			        $output .= $label . ':</td>';
                        $output .= "<td><select name=\"$cols->Field\">";

                        while ($stmt2->fetch()) {
                            $output .= "<option value=\"$id\">$name - $city</option>";

                        }

                        $output .= "</select></td>";

                        $stmt2->close();
			}

			$output .= "</tr>";
			print $output;

		}

	}

	print "<tr><td style=\"text-align:center\" colspan=\"2\"><input type=\"submit\" class=\"button\" value=\"SAVE\">
			<button type=\"button\" name=\"btnCancel\" class=\"button\" onClick=\"window.close();\">CANCEL</button></td></tr>";
	$stmt->close();

}



/*
 * FORMAT STRINGS (phone#, email)
*/
function format($type, $data) {
	switch ($type) {
		case 'phone':
			$phone[0] = substr($data, 0, 3);
			$phone[1] = substr($data, 3, 3);
			$phone[2] = substr($data, 6, 4);
			return implode('-', $phone);
			break;
		case 'email':
			break;
	}
}

/* FUNCTION TO GET COLUMN NAMES FOR GIVEN DB / TABLE
 * RECEIVES: name of table to query
 * RETURNS: column names
 */
function getColumns($table_name) {
	global $db_connection;

	$stmt = $db_connection->prepare("SHOW FULL COLUMNS FROM $table_name WHERE type != 'blob'");

	$stmt->execute();
	$stmt->bind_result($col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8, $col9);

	$index = 0;
	while ($stmt->fetch()) {
		$cols[$index] = array($col1, $col2, $col3, $col4, $col5, $col6, $col7, $col8, $col9);
		$index++;
	}

	$stmt->close();

	return $cols;
}

/*
 * FUNCTION TO RETRIEVE AND PROCESS POSSIBLE VALUES FOR A SET COLUMN TYPE
 * ACCEPTS VARIABLE ARGUMENTS:
 * IF MORE THAN 1 ARG THE ORDER IS: TABLE NAME, COLUMN NAME
 * SINGLE ARG IS A STRING VALUE CONTAINING THE VALUES FROM THE SET COLUMN TYPE
 */
function getColumnSetValues() {
	global $db_connection;

	$num_args = func_num_args();

	/*
	 * IF 2 ARGS PASSED, VALUES ARE ARG0=db connection object, ARG1=table_name, ARG2=field_name
	 * SET VALUES NEED TO BE GLEENDED FROM DATABASE BEFORE BEING PARSED BELOW
	 */
	if ($num_args > 1) {
		$args = func_get_args();
		$result = $db_connection->query("SHOW COLUMNS FROM $args[0] WHERE Field = '$args[1]'");
		$db_data = $result->fetch_object();

		$values = $db_data->Type;

	/*
	 * IF 1 ARG PASSED, VALUE IS DATA FROM SET THAT NEEDS TO BE PARSED
	 */
	} else {
		$values = func_get_arg(0);
	}

	$values = preg_replace("/^set\(/", "", $values);
	$values = preg_replace("/\)$/", "", $values);
	$values = preg_replace("/'/", '', $values);

	$values = explode(",", $values);

	return $values;

}


/*
 * GET AND/OR SET $customer_id
 */
function getCustomerID() {

	$num_args = func_num_args();

	if ($num_args > 1) {
		$args = func_get_args();
		$result = $args[0]->query("SELECT customer_id FROM orders WHERE order_number = '" . $args[1] . "'");
		$cid = $result->fetch_object();
		$result->close();
		return $cid->customer_id;
	} else {
		if (isset($_POST['cid']) && is_numeric($_POST['cid'])) {
			return $_POST['cid'];
		} elseif (isset($_GET['cid']) && is_numeric($_GET['cid'])) {
			return $_GET['cid'];
		} else {
			return NULL;
		}
	}

}

/*
 * GET ORDER ID
*/
function getOrderID($onum) {
	global $db_connection;

	$result = $db_connection->query("SELECT order_id FROM orders WHERE order_number = $onum");

	$data = $result->fetch_object();

	$result->close();

	return $data->order_id;
}

/*
 * GET ORDER NUMBER
*/
function getOrderNumber() {

	if (isset($_POST['onum']) && is_numeric($_POST['onum'])) {
		return $_POST['onum'];
	} elseif (isset($_GET['onum']) && is_numeric($_GET['onum'])) {
		return $_GET['onum'];
	} else {
		return NULL;
	}

}

/*
 * SET ORDER NUMBER FOR NEW ORDER
*/
function getNextOrderNumber() {
	global $db_connection;

	$result = $db_connection->query("SELECT IFNULL(MAX(order_number),  0) AS onum FROM orders");
	$order = $result->fetch_object();
	$onum = $order->onum + 1;
	$result->close();

	return $onum;

}


/*
 * GET ORDER TOTALS
 * RECEIVES PARAMS: database connection object, order number
 * RETURNS: order subtotal, total shipping charge, sales tax, discount total, order grand total
*/
function getOrderTotals($onum) {
	global $db_connection;

	$result = $db_connection->query("SELECT order_ship_total, order_subtotal, order_sales_tax, order_discount
						FROM orders
						WHERE order_number = " . $onum);

	$totals = $result->fetch_object();

	$order_total = $totals->order_subtotal + $totals->order_ship_total + $totals->order_sales_tax -$totals->order_discount;

	return array($totals->order_subtotal, $totals->order_ship_total, $totals->order_sales_tax, $totals->order_discount, $order_total);

}


function getValue($key) {

	if (isset($_POST[$key])) {
		return $_POST[$key];
	} elseif (isset($_GET[$key])) {
		return $_GET[$key];
	} else {
		return NULL;
	}

}

/*
 * INSERT NEW RECORD INTO DATABASE
* RECEIVES: database connection object, table to insert into, primary key of table
* RETURNS: nothing
*/
function insertRecord($table_name, $key = NULL) {
	global $lowercase_fields;
	global $db_connection;

	$cols = getColumns($table_name);

	$insert_query = "INSERT INTO $table_name(";


	foreach ($cols as $col) {
		if ($col[0] != $key && (isset($_POST[$col[0]]) && $_POST[$col[0]] != '')) {
			$insert_query .= "$col[0],";
		}
	}

	$insert_query = preg_replace('/,$/', '', $insert_query);

	$insert_query .= ") VALUES(";

	foreach ($cols as $col) {
		if ($col[0] != $key && (isset($_POST[$col[0]]) && $_POST[$col[0]] != '')) {
			if (in_array($col[0], $lowercase_fields)) {
				$_POST[$col[0]] = strtolower($_POST[$col[0]]);
			}

			if ($col[0] == 'password') {
			  $insert_query .= "SHA1(" . $_POST[$col[0]] . "),";
			} else {
			  $insert_query .= "'" . $_POST[$col[0]] ."',";
			}
		}
	}

	$insert_query = preg_replace('/,$/', '', $insert_query);
	$insert_query .= ")";

//	print "INSERTING INTO " . $table_name . " : " . $insert_query . "<br />";

	$result = $db_connection->query("$insert_query");

	if ($db_connection->error) {
	  echo $db_connection->error;
	}

	return $db_connection->insert_id ? $db_connection->insert_id : true;

}

/*
 * SAVE RECORD TO DATABASE
 * RECEIVES: table to save to, primary key of table
 * RETURNS: nothing
*/
function saveRecord($table_name, $key) {
	global $db_connection;

	$cols = getColumns($table_name);

	$update_query = "UPDATE $table_name SET ";

	foreach ($cols as $col) {
		if ($col != $key[0] && isset($_POST[$col])) {
			$update_query .= "$col = $_POST[$col], ";
		}
	}

	$update_query .= " WHERE $key[0] = $key[1]";

	$db_connection->prepare($update_query)->execute();

	$db_connection->commit();

}

/*
 * REMOVE ORDER ITEMS AND INSERT FROM FORM
 * RECALCULATE SUBTOTAL AND RETURN
 */
function updateOrderItems($oid) {
  global $db_connection, $db_connection2;

  $stmt = $db_connection->query("DELETE FROM order_line_items WHERE order_id = $oid");

// SAVE ORDER ITEMS
  $stmt = $db_connection->prepare("INSERT INTO order_line_items(order_id, line_no, quantity, product_id, price,
											ext_price, personalization, production_details)
											VALUES(?, ?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("iiisddss", $oid, $lineno, $qty, $product_id, $price, $ext_price, $personalization, $production_details);

  foreach ($_POST as $k => $v) {

    if (preg_match('/^qty_/', $k) && $v > 0) {

	list($gar, $lineno)     = explode('_', $k);
	$product_id 		= $db_connection2->escape_string($_POST["product_id_$lineno"]);
	$qty 				= $v;
	$price 			= $db_connection2->escape_string(sprintf("%2f", $_POST["price_$lineno"]));
	$ext_price 			= $db_connection2->escape_string(sprintf("%2f", $_POST["ext_price_$lineno"]));

	$subtotal += $ext_price;

	if ($_POST["personalization_$lineno"] != 'PERSONALIZATION') {
	  $personalization 	= $db_connection2->escape_string($_POST["personalization_$lineno"]);
	}

	if ($_POST["production_details_$lineno"] != 'PRODUCTION OPTIONS') {
	  $production_details   = $db_connection2->escape_string($_POST["production_details_$lineno"]);
	}

	$stmt->execute();

    }
  }


  $stmt->close();

  return $subtotal;
}


function isAdmin() {
	global $db_connection;

	$associate_id = $_COOKIE['HWO_ASSOCID'];

	$result = $db_connection->query("SELECT admin FROM associates WHERE associate_id = " . $associate_id);
	$data = $result->fetch_object();

	return $data->admin;


}

function fixLineEndings($txt) {
  $txt = preg_replace('/\\\r\\\n/', "\n", $txt);
  return $txt;
}


function errorPage($err_msg, $link, $link_text) {

   print "$err_msg";

}


?>
