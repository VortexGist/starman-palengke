<?php

require_once './core/script-products.php';
require_once './core/script-session.php';

class CartItem
{
    public Product $product;
    public int $quantity;
    public function __construct(Product $product, int $quantity = 0)
    {
        $this->product = $product;
        $this->quantity = $quantity;
    }
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

function addToCart(Product $product, int $quantity)
{
    array_push($_SESSION['cart'], new CartItem($product, $quantity));
}

function cartContainsItem(string $category, int $index) {
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