<?php
$calling_file = basename(__FILE__);
require_once 'init.php';
require_once 'header.php';

$store_query = "SELECT * FROM stores";

$store_stmt = $db_connection->query($store_query);

if (isset($_FILES['logo']['name'])) {
  $saved_logo = __DIR__ . DSEP .  $config['image_directory'] . $_FILES['logo']['name'];
  move_uploaded_file($_FILES['logo']['tmp_name'], $saved_logo);
  $stmt = $db_connection->query("UPDATE stores SET logo = '" . $_FILES['logo']['name'] . "' WHERE store_id = " . $_POST['store_id']);
}
?>


<div id="mainContainer">

	<h1 class="admin">STORE MANAGEMENT</h1>

	<div id="mainContainerLeft">
		<div style="padding-top:30px;padding-left:30px">
		<a class="button" href="javascript:overlayWindow('store_new.php?caller=stores.php', '480', '600')">Add Store</a>
		</div>

          <?php if (isset($_GET['show_logo'])) : ?>
            <?php
              $result = $db_connection->query("SELECT logo FROM stores WHERE store_id = " . $_GET['store_id']);
              $image_name = $result->fetch_object();

            ?>
		    <div style="padding-top:50px;padding-left:30px">
		    <div style="margin-bottom:10px;font-weight:bold">Store Logo</div>
		    <div style="margin-bottom:20px">
		    <img src="<?= $config['image_directory'] . $image_name->logo ?>" width="300"/>
		    </div>
		    </div>
		    <div style="padding-top:50px;padding-left:30px">
		    <div style="margin-bottom:10px;font-weight:bold">Upload Store Logo</div>
		    <div style="margin-bottom:20px">
		    <form method="post" enctype="multipart/form-data">
		    <input type="hidden" name="store_id" value="<?= $_GET['store_id']?>">
		    <input type="hidden" name="calling_file" value="stores.php">
		    <input type="file" name="logo">
		    <input class="button" type="submit" name="submit" value="Upload">
		    </form>
		    </div>
		    </div>
	    <?php else : ?>
		<div style="padding-top:50px;padding-left:30px">
		<div style="margin-bottom:10px;font-weight:bold">StoreLogo</div>
		<div style="margin-bottom:20px">
		  Select store to see logo...
		</div>
		</div>
	    <?php endif ?>
	</div>

	<div id="mainContainerRight">
	<div class="rightScroll">
	<?php while ($result = $store_stmt->fetch_object()) : ?>

		<div onClick="window.location='stores.php?show_logo=1&store_id=<?=$result->store_id?>'" style="margin-left:10px;margin-bottom:20px">
		<strong><?= $result->store_name;?></strong><br />
		<?= $result->address1;?><br />
		<?php echo $result->address2 ? $result->address2 . '<br />' : false ;?>
		<?= $result->city;?>, <?= $result->state;?> <?= $result->postal_code;?><br />
		<?= $result->phone;?><br />
		<?= $result->store_email;?>
		</div>
      <?php endwhile ?>
	</div>
	</div>



</div>
</div>

</body>
</html>