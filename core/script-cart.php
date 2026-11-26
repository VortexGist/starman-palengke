<?php

// // require_once './core/script-products.php';
// require_once './core/script-session.php';
// require_once './core/script-db.php';

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

function addToCart(int $productID, int $quantity)
// function addToCart(Product $product, int $quantity)
{
    foreach ($_SESSION['cart'] as $id => $item) {
        // var_dump("item product id=" . $item->productID);
        // var_dump("product id=" . $productID);
        // Check if id matches
        if ($item->productID === $productID) {
            $item->quantity += $quantity;
            return;
        }
    }

    array_push($_SESSION['cart'], new CartItem($productID, $quantity));
    // $product = DB::getProductByID($productID);
    // global $products;

    // foreach ($products[$product] as $id => $stock) {
    //     if (in_array($stock->name, $product->name)) {

    //     }
    // }

    // array_push($_SESSION['cart'], new CartItem($product, $quantity));
}

function cartContainsItem(string $category, int $index)
{
    // $_SESSION['cart']
}

function clearCart()
{
    array_splice($_SESSION['cart'], 0, sizeof($_SESSION['cart']));
}

function removeFromCartByIndex(int $index)
{
    array_splice($_SESSION['cart'], $index, $index);
}

function removeFromCart(Product $product)
{
    $_SESSION['cart'] = array_filter(
        $_SESSION['cart'],
        fn($p) => $p !== $product
    );
}
