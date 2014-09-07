<?php
require_once('init.php');
$username = $_POST['username'];
$password = $_POST['password'];

if (empty($username) || empty($password)) {
    $errors[] = 'Please enter a username and password';
    include('login_form.php');

} elseif (user_exists($username) === false) {
    $errors[] = 'The user does not exist';
    include('login_form.php');
    
} else {

	$stmt = $db->query("SELECT u.user_id, u.username
									FROM users AS u
									LEFT JOIN stores_users AS su USING(user_id)
									WHERE su.store_id = " . $_POST['store_id'] . "
									AND username = '$username'
									AND password = SHA1('$password')");
	
    if ($result = $stmt->fetch_object()) {
       	setcookie('SYZYGY_STOREID', $_POST['store_id']);
		setcookie('SYZYGY_USERID', $result->user_id);
		setcookie('SYZYGY_USER', $result->username);     
		$_SESSION['user_id'] = $result->user_id;
		header("location: /control/dashboard");
	} else {
		$errors[] = 'Login failed...please try again...';
	}

}

?>

