<?php
require_once __DIR__ . '/script-init.php';
require_once __DIR__ . '/script-product-page.php';

// Go to home page if not POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
	header('Location: /'.PROJECT_FOLDER.'index.php');
	exit;
}

unset($_SESSION['add-to-cart']['button-content']);

$category = $_POST['product-category'];
$categoryProducts = DB::getProducts($category);
$excludedID = $_POST['product-id'];
$_SESSION['similar-products'] = generateSimilarItemIDs($categoryProducts, 7, $excludedID);

// Persist product
$_SESSION['product']['id'] = $_POST['product-id'];
$_SESSION['product']['category'] = $_POST['product-category'];
$_SESSION['product']['quantity'] = $_POST['product-quantity'];

if (isset($_POST['redirect'])) {
	header('Location: /'.PROJECT_FOLDER.$_POST['redirect']);
	exit;
}

header('Location: /'.PROJECT_FOLDER.'product-page.php');
exit;