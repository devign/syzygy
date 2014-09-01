<?php
require_once('functions.php');

?>


<?php if (isset($action) && $action == 'create_user') : ?>

<?php
	$associate_id = insertRecord('associates', 'associate_id');

	$_POST['associate_id'] = $associate_id;

	insertRecord('stores_associates');

?>

          <div class="col-xs-12 col-md-9">
             
            <section id="page-header">

              <h1><span class="glyphicon glyphicon-home"></span> Product Categories :: Create New</h1>

            </section>

            <section id="content">

<div style="padding-top:100px">
	<h3>ASSOCIATE SUCCESSFULLY ADDED</h3>
</div>
<div>
	<button class="button" onCLick="window.opener.location='<?= $_POST['caller']?>';window.close()">CLOSE</button>

</div>

<?php else : ?>

<div>
	<div style="padding:20px">
		<h3>ENTER USER INFORMATION</h3>
		<form name="userNew" method="post">
		<input type="hidden" name="action" value="create_user">
		<input type="hidden" name="caller" value="<?= $_GET['caller']?>">

	<?php
		createInputForm('associates');
	?>

		</form>
	</div>

</div>

<?php endif ?>


            </section>

          </div><!-- /.col-sm-12 /.col-lg-9 -->
