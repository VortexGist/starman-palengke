<?php
    require_once './core/script-init.php';
    require_once './core/script-cart.php';
    // require_once './core/script-page-gen.php';
    // // require_once './core/script-products.php';
    // require_once './core/script-cart.php';
    // require_once './core/script-session.php';
    // require_once './core/script-util.php';
    // session_destroy();

    $_SESSION['last-page'] = 'cart';

    // if ($_SERVER['http-request-method'] === 'POST') {
    //     if (isset($_POST['action-products'])) {
    //         if ($_POST['action-products'] === 'add-to-cart') {
    //             addToCart((int) $_POST['product-id'], 1);
    //             // toast '<name> added to cart!' message here
    //         }
    //     }
    // }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart | Starman Palengke</title>
    <link rel="stylesheet" href="./styles/theme.css">
    <link rel="stylesheet" href="./styles/cart.css">
</head>

<body>
    <?php generateHeader(); ?>
    <main>
        <h1>Your Cart</h1>
        <div id="cart">
            <?php
                if (sizeof($_SESSION['cart']) === 0) {
                ?>
                <p id="empty-cart-message">The cart is empty. Check out the products and try adding them to the cart. </p>
            <?php
            }?>

            <form method="POST" action="./checkout.php">
            <div id="cart-items">
                <?php
                    $total = 0.0;

                    foreach ($_SESSION['cart'] as $i => $item) {
                        // calculate total
                        $product  = DB::getProductByID($item->productID);
                        $total   += (float) $product['price'] * $item->quantity;
                    ?>
                    <div class="item">
                        <div class="image-container"><img src="./assets/<?php echo $product['image'] ?>"></div>
                        <p class="description"><?php echo $product['name']; ?></p>
                        <p class="price"><?php echo number_format($product['price'], 2); ?>
                            PHP/<?php echo $product['price_unit']; ?></p>
                        <div class="quantity-controls">
                            <input class="input-item-quantity" type="number" name="item-quantity-<?= $i ?>" min="1" value="<?= $item->quantity ?? 1 ?>">
                        </div>
                        <p class="subtotal">
                            <?php echo (float) $product['price'] * $item->quantity; ?> PHP
                        </p>
                        <button class="btn-remove-item" type="submit" name="remove-item-id" value="<?= $item->productID?>" formaction="./core/action-remove-cart-item.php">REMOVE</button>
                    </div>
                <?php
                    }
                ?>
            </div>
            <div id="cart-details">
                <div id="cart-total-label">
                    <p>TOTAL:</p>
                </div>
                <div id="cart-total-amount">
                    <p><?php echo number_format($total, 2); ?> PHP</p>
                </div>
            </div>
                <button id="btn-checkout" type="submit">CHECKOUT</button>
            </form>
        </div>
    </main>
    <?php generateFooter(); ?>
</body>

</html>