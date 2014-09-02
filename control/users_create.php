<?php
require_once('functions.php');

?>

          <div class="col-xs-12 col-md-9">
             
            <section id="page-header">

              <h1><span class="glyphicon glyphicon-home"></span> Users :: Create New</h1>

            </section>

            <section id="content">
            
<?php if (isset($action) && $action == 'create_user') : ?>

<?php
	$associate_id = insertRecord('users', 'user_id');

	$_POST['user_id'] = $user_id;

	insertRecord('stores_users');

?>



<div style="padding-top:100px">
	<h3>USER SUCCESSFULLY ADDED</h3>
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


	<?php
		createInputForm('users');
	?>

		</form>
	</div>

</div>

<?php endif ?>


            </section>

          </div><!-- /.col-sm-12 /.col-lg-9 -->
