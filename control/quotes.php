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
	$main_stmt = $db_connection->query("SELECT quote_id, quote_number, date, company_name, assoc.first_name AS fname, assoc.last_name AS lname
								FROM quotes AS q
								LEFT JOIN customers AS c USING(customer_id)
								LEFT JOIN associates AS assoc USING(associate_id)
								WHERE c.customer_id = $customer_id
								ORDER BY 1 ASC");	
	
} else {
	$main_stmt = $db_connection->query("SELECT quote_id, quote_number, date, company_name, assoc.first_name, assoc.last_name
								FROM quotes AS q
								LEFT JOIN customers AS c USING(customer_id)
								LEFT JOIN associates AS assoc USING(associate_id)
								ORDER BY 1 ASC");	
}
?>

	<div id="mainContainer">
		<div id="mainContainerLeft">
			<form name="searchForm" action="customers.php" method="post">
			<input type="hidden" name="action" value="search">		
			<div id="searchCriteria">
	
				<table>
					<tr><td class="inputLabel">COMPANY</td><td><input type="text" name="company_name" value="<?php echo $customer_info->company_name ?>" size="20"></td>
					<tr><td class="inputLabel">CONTACT</td><td><input type="text" name="contact_name" value="<?php echo $customer_info->name ?>"size="20"></td>
					<tr><td class="inputLabel">SALES REP</td><td><input type="text" name="sales_rep" value="<?php echo $customer_info->sales_rep ?>"size="20"></td>
				</table>
			</div>
			<div id="searchButtonContainer">
				<img src="images/search-button.png" onClick="searchForm.submit()"; />
			</div>
			</form>

			
			<div id="customerOrders">
				<table class="lineDetails">
				<tr><th colspan="3"></th></tr>
			<?php 


			?>
				
					
				</table>
			</div>
		
		</div>
		
		<div id="mainContainerRight">
			<table class="detailsList">
				<tr><th>QUOTE NUMBER</th><th>DATE</th><th>COMPANY</th><th>ASSOCIATE</th></tr>
			<?php 

				
					while ($result = $main_stmt->fetch_object()) {
						print "<tr><td><a href=\"quote_details.php?qid=$result->quote_id\">$result->quote_number</a></td><td>$result->date</td><td>$result->company_name</td><td>$result->fname $result->lname</td></tr>";
					}
				
			
			
			?>
			</table>
		</div>
	</div>

</div>

</body>