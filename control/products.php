<?php
$calling_file = basename(__FILE__);
require_once 'init.php';
require_once 'header.php';

?>

<div id="mainContainer">

	<h1 class="admin">PRODUCT MANAGEMENT</h1>
	
	<div id="mainContainerLeft">
		<div style="padding-top:30px;padding-left:30px">
		<a class="button" href="javascript:void overlayWindow('product_new.php?caller=products.php', '480', '500')">Add Product</a>
		</div>
		<div style="padding-top:30px;padding-left:30px">
		<a class="button" href="product_list.php?caller=products.php">List Products</a>
		</div>
		
	</div>
	
	<div id="mainContainerRight">
	
	</div>


</div>
</div>

</body>
</html>