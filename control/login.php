<?php



if (isset($_POST['userid'])) {
	$userid = $_POST['userid'];
	$password = $_POST['password'];


	$stmt = $db->query("SELECT a.associate_id, a.username
									FROM associates AS a
									LEFT JOIN stores_associates AS sa USING(associate_id)
									WHERE sa.store_id = " . $_POST['store_id'] . "
									AND username = '$userid'
									AND password = SHA1('$password')");
	$result = $stmt->fetch_object();

	if ($result->associate_id) {
		setcookie('SYZYGY_STOREID', $_POST['store_id']);
		setcookie('SYZYGY_ASSOCID', $result->associate_id);
		setcookie('SYZYGY_USER', $result->username);
		session_start();
		header("location: dashboard.php");
	} else {
		$error_msg = 'Login failed...please try again...';
	}

}




?>

<body>
<div id="pageContainer">
	<div id="loginContainer">
		<div id="loginBox">
			<div id="logo"><img src="<?= $config['image_directory'] . $config['site_logo']?>" /></div>
			<?php if (isset($error_msg)) :?>
				<div class="errorMessage">
	 				<?= $error_msg?>
	 			</div>
	 		<?php else :?>
				<div class="instruct"><?= $config['login_instructions']?></div>
	 		<?php endif?>
	 		<div id="loginArea">
				<form name="formLogin" method="post" action="login.php">
				<div class="inputLabel">USERNAME:</div>
				<input autocomplete="off" type="text" name="userid" value="" size="25">
				<br/>
				<br/>
				<div class="inputLabel">PASSWORD:</div>
				<input autocomplete="off" type="password" name="password" value="" size="25">
				<br/><br/>
				<a href="#" onClick="formLogin.submit();"><img src="<?= $config['image_directory']?>login-button.jpg"/></a>
				</form>
			</div>
		</div>
	</div>

</div>


<?php
	$result->free();
	$stmt->close();

	dbDisconnect($db_connection);
?>
