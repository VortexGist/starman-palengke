<?php
require_once __DIR__ . '/script-init.php';

// Go to home page if not POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
	header('Location: /'.PROJECT_FOLDER.'index.php');
	exit;
}

session_unset();
session_destroy();

header('Location: /'.PROJECT_FOLDER.'account.php');
exit;