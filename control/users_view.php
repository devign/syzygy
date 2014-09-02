<?php

$users_query = "SELECT * FROM associates";

$users_stmt = $db->query($users_query);

?>

          <div class="col-xs-12 col-md-9">
             
            <section id="page-header">

              <h1><span class="glyphicon glyphicon-home"></span> Product Categories :: Create New</h1>

            </section>

            <section id="content">
	<h1 class="admin">USER MANAGEMENT</h1>

	<div id="mainContainerLeft">
		<div style="padding-top:30px;padding-left:30px">
		<a class="button" href="/control/users/create">Add User</a>
		</div>
	</div>

	<div id="mainContainerRight">
	<div class="rightScroll">
	<table border="0" id="usersTable" cellpadding="0" cellspacing="0">
	<tr><th></th><th>First Name</th><th>Last Name</th><th>Username</th></tr>
	<?php while ($result = $users_stmt->fetch_object()) : ?>
		<tr>
		<td valign="center"><a onMouseOver="$(this).parents('tr').css('background-color', '#F2B7B2')"
		          onMouseOut="$(this).parents('tr').css('background-color', '#F7FAEF')" class="miniButton" href="/control/users/edit/<?= $result->user_id?>">Edit</a></td>
		<td><?= $result->first_name ?></td>
		<td><?= $result->last_name ?></td>
		<td><?= $result->username ?></td>
		</tr>
	<?php endwhile ?>
	</table>
	</div>
	</div>




            </section>

          </div><!-- /.col-sm-12 /.col-lg-9 -->

