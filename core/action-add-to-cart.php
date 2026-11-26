<?php
require_once __DIR__ . '/script-init.php';
require_once __DIR__ . '/script-cart.php';

// Go to home page if not POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
	header('Location: /'.PROJECT_FOLDER.'/'.'index.php');
	exit;
}

addToCart($_POST['product-id'] ?? $_SESSION['product']['id'], $_SESSION['product']['quantity'] ?? $_POST['product-quantity'] ?? 1);

$_SESSION['add-to-cart']['button-content'] = 'ADDED TO CART';

// echo "item added";

if (isset($_POST['redirect'])) {
	header('Location: /'.PROJECT_FOLDER. '/'.$_POST['redirect']);
	exit;
}

// echo __DIR__ . '/../cart.php';
header('Location: /'.PROJECT_FOLDER.'/cart.php');
exit;