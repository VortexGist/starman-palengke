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

    if ($_SERVER['http-request-method'] === 'POST') {
        if (isset($_POST['action-products'])) {
            if ($_POST['action-products'] === 'add-to-cart') {
                addToCart((int) $_POST['product-id'], 1);
                // toast '<name> added to cart!' message here
            }
        }
    }

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
            <div id="cart-items">
                <?php
                    $totalCost = 0;

                    foreach ($_SESSION['cart'] as $id => $item) {
                        if ($item === null) {
                            continue;
                        }

                        // $product = $item->product;
                        // if ($product === null) continue;
                        // calculate total
                        $product    = DB::getProductByID($item->productID);
                        $totalCost += $product['price'];
                    ?>
                    <div class="item">
                        <div class="image-container"><img src="./assets/<?php echo $product['image'] ?>"></div>
                        <p class="description"><?php echo $product['name']; ?></p>
                        <p class="price"><?php echo number_format($product['price'], 2); ?>
                            PHP/<?php echo $product['price_unit']; ?></p>
                        <div class="quantity-controls">
                            <button class="btn-add-item-quantity">+</button>
                            <p><?php echo $item->quantity; ?></p>
                            <button class="btn-subtract-item-quantity">-</button>
                        </div>
                        <p class="subtotal">
                            <?php echo (float) $product['price'] * $item->quantity; ?> PHP
                        </p>
                        <button class="btn-remove-item">REMOVE</button>
                    </div>
                <?php }?>

                <!-- <?php
                         $totalCost = 0;

                         foreach ($_SESSION['cart'] as $item) {
                             if ($item === null) {
                                 continue;
                             }

                             $product = $item->product;
                             if ($product === null) {
                                 continue;
                             }

                             // calculate total
                         $totalCost += $product->price;
                         ?> -->
                <!-- <div class="item">
                        <div class="image-container"><img src="./assets/<?php echo $product->image ?>"></div>
                        <p class="description"><?php echo $product->name; ?></p>
                        <p class="price"><?php echo number_format($product->price, 2); ?>
                            PHP/<?php echo $product->priceUnit; ?></p>
                        <div class="quantity-controls">
                            <button class="btn-add-item-quantity">+</button>
                            <p>1</p>
                            <button class="btn-subtract-item-quantity">-</button>
                        </div>
                        <p class="subtotal">
                            <?php echo $product->price * $item->quantity; ?> PHP
                        </p>
                        <button class="btn-remove-item">REMOVE</button>
                    </div> -->
                <!-- <?php }?> -->
            </div>
            <div id="cart-details">
                <div id="cart-total-label">
                    <p>TOTAL:</p>
                </div>
                <div id="cart-total-amount">
                    <p><?php echo number_format($totalCost, 2); ?> PHP</p>
                </div>
            </div>
            <form method="POST" action="./checkout.php">

                <button id="btn-checkout" type="submit">CHECKOUT</button>
            </form>
        </div>
    </main>
    <?php generateFooter(); ?>
</body>

</html>