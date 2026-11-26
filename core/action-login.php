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

	$hashPassword = password_hash($password, PASSWORD_DEFAULT);

	$sql = 'SELECT * FROM accounts WHERE username=?';
	$mysql = DB::getConnection();
	$statement = $mysql->prepare($sql);
	$statement->bind_param("s", $username);
	$status = $statement->execute();
	$result = $statement->get_result();
	$user = $result->fetch_assoc();

	if (!$user || !password_verify($password, $user['password'])) {
		$_SESSION['error']['message'] = 'Incorrect username or password.';
		header('Location: /'.PROJECT_FOLDER.'login.php');
		exit;
	}

	if (isset($_POST['redirect'])) {
		header('Location: /'.PROJECT_FOLDER.$_POST['redirect']);
		exit;
	}

	// delete old session data and start a new one
	session_regenerate_id(true);

	$_SESSION['user']['id'] = $user['id'];
	$_SESSION['user']['name'] = $user['username'];
	$_SESSION['success']['message'] = 'Login successfully';

	header('Location: /'.PROJECT_FOLDER.'account.php');
	exit;
} catch (mysqli_sql_exception $e) {
	error_log($e->getMessage());
}