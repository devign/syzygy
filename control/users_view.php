<?php
$calling_file = basename(__FILE__);
require_once 'init.php';
require_once 'header.php';

$associates_query = "SELECT * FROM associates";

$associates_stmt = $db_connection->query($associates_query);

?>

<div id="mainContainer">

	<h1 class="admin">USER MANAGEMENT</h1>

	<div id="mainContainerLeft">
		<div style="padding-top:30px;padding-left:30px">
		<a class="button" href="javascript:overlayWindow('user_new.php?caller=users.php', '480', '500')">Add User</a>
		</div>
	</div>

	<div id="mainContainerRight">
	<div class="rightScroll">
	<table border="0" id="usersTable" cellpadding="0" cellspacing="0">
	<tr><th></th><th>First Name</th><th>Last Name</th><th>Username</th></tr>
	<?php while ($result = $associates_stmt->fetch_object()) : ?>
		<tr>
		<td valign="center"><a onMouseOver="$(this).parents('tr').css('background-color', '#F2B7B2')"
		          onMouseOut="$(this).parents('tr').css('background-color', '#F7FAEF')" class="miniButton" href="#" onClick="overlayWindow('user_edit.php?associate_id=<?= $result->associate_id?>', 400, 600)">Edit</a></td>
		<td><?= $result->first_name ?></td>
		<td><?= $result->last_name ?></td>
		<td><?= $result->username ?></td>
		</tr>
	<?php endwhile ?>
	</table>
	</div>
	</div>

</div>
</div>

</body>
</html>