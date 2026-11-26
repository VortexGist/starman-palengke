<?php
require_once __DIR__ . '/script-init.php';

// Go to home page if not POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
	header('Location: /'.PROJECT_FOLDER.'index.php');
	exit;
}

unset($_SESSION['success']['message']);
unset($_SESSION['error']['message']);

try {
	$username = $_POST['user-name'];
	$password = $_POST['user-password'];
	$confirmPassword = $_POST['user-confirm-password'];

	if ($confirmPassword !== $password) {
		$_SESSION['error']['message'] = 'Password and confirm password must match';
		header('Location: /'.PROJECT_FOLDER.'/signup.php');
		exit;
	}

	$hashPassword = password_hash($password, PASSWORD_DEFAULT);

	$sql = 'INSERT INTO accounts (username, password) VALUES (?, ?)';
	$mysql = DB::getConnection();
	$statement = $mysql->prepare($sql);
	$statement->bind_param("ss", $username, $hashPassword);

	if (!$statement->execute()) {
		$_SESSION['error']['message'] = 'SIGNUP ERROR';
		header('Location: /'.PROJECT_FOLDER.'/login.php');
		exit;
	}

	if (isset($_POST['redirect'])) {
		header('Location: /'.PROJECT_FOLDER. '/'.$_POST['redirect']);
		exit;
	}

	// if ($error) {
	// 	header('Location: /'.PROJECT_FOLDER.'/login.php');
	// 	exit;
	// }

	$_SESSION['success']['message'] = 'Account created successfully';

	header('Location: /'.PROJECT_FOLDER.'/login.php');
	exit;

} catch (mysqli_sql_exception $e) {
	$DUPLICATE_ENTRY_ERROR = 1062;
	if ($e->getCode() == $DUPLICATE_ENTRY_ERROR) {
		$_SESSION['error']['message'] = 'Username "'.$username.'" already exists';
		header('Location: /'.PROJECT_FOLDER.'/signup.php');
		exit;
	}

	error_log($e->getMessage());
	// die($e->getMessage());
}