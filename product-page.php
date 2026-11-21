<?php
require_once "./core/script-session.php";
require_once "./core/script-page-gen.php";
require_once "./core/script-products.php";
require_once "./core/script-product-page.php";
require_once "./core/script-cart.php";

if (
    $_SESSION['last-page'] !== 'product-page'
    || (isset($_POST['action-product-page'])
        && $_POST['action-product-page'] === 'similar-item')
) {
    deleteCache('product-page', 'indices');
}

// Check if product exists in cart
// if (cartContainsItem($_POST['product-name'])) {
//     $_
// }
// if (
//     $_SESSION['last-page'] !== 'product-page'
//     || (isset($_POST['action-product-page']) 
//         && $_POST['action-product-page'] === 'similar-item')
// ) {
//     // echo $_SESSION['last-page'];
//     deleteCache('product-page', 'indices');

//     // deleteCache('product-page', 'image');
//     // deleteCache('product-page', 'name');
//     // deleteCache('product-page', 'price');
//     // deleteCache('product-page', 'category');
//     // deleteCache('product-page', 'description');
//     // deleteCache('product-page', 'index');
//     // deleteCache('product-page', 'price-unit');
// }

$_SESSION['last-page'] = 'product-page';

// $_SESSION['item-quantity'] = 0;
$addToCartText = 'ADD TO CART';

$product_image =
    $product_price_unit =
    $product_name =
    $product_price =
    $product_description =
    $product_category =
    $product_index = null;

function setCaches()
{
    $GLOBALS['product_image'] = $_POST['product-image'];
    $GLOBALS['product_name'] = $_POST['product-name'];
    $GLOBALS['product_price'] = (float) $_POST['product-price'];
    $GLOBALS['product_description'] = $_POST['product-description'];
    $GLOBALS['product_category'] = $_POST['product-category'];
    $GLOBALS['product_index'] = (int) $_POST['product-index'];
    $GLOBALS['product_price_unit'] = $_POST['product-price-unit'];

    setCacheValue('product-page', 'image', $GLOBALS['product_image']);
    setCacheValue('product-page', 'name', $GLOBALS['product_name']);
    setCacheValue('product-page', 'price', $GLOBALS['product_price']);
    setCacheValue('product-page', 'category', $GLOBALS['product_category']);
    setCacheValue('product-page', 'index', $GLOBALS['product_index']);
    setCacheValue('product-page', 'description', $GLOBALS['product_description']);
    setCacheValue('product-page', 'price-unit', $GLOBALS['product_price_unit']);
}

function retrieveCaches()
{
    // Use cached values
    $GLOBALS['product_image'] = getCacheValue('product-page', 'image');
    $GLOBALS['product_name'] = getCacheValue('product-page', 'name');
    $GLOBALS['product_price'] = (float) getCacheValue('product-page', 'price');
    $GLOBALS['product_category'] = getCacheValue('product-page', 'category');
    $GLOBALS['product_description'] = getCacheValue('product-page', 'description');
    $GLOBALS['product_index'] = (int) getCacheValue('product-page', 'index');
    $GLOBALS['product_price_unit'] = getCacheValue('product-page', 'price-unit');
}

if (isset($_POST['action-product-page'])) {
    if ($_POST['action-product-page'] === 'add-to-cart') {
        addToCart($products[$_POST['product-category']][(int) $_POST['product-index']], 1);
        $addToCartText = 'ITEM ADDED TO CART';
        // $_SESSION['flag-added-to-cart'] = true;
        // echo "item added to cart";
        // Use cached values
        retrieveCaches();

        // echo "SET CACHE SIMILAR ITEMS";
        // toast '<name> added to cart!' message here
    } else if ($_POST['action-product-page'] === 'similar-item') {
        // Get values then cache it
        setCaches();
        // echo "SET CACHE SIMILAR ITEMS";
        // echo "similar -item";
    } else {
        // echo "CACHED VALUES RETRIEVED";

        // Use cached values
        retrieveCaches();
    }
} else {
    // Get values then cache it
    setCaches();
    // echo "MC DUFFIN";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product | Starman Palengke</title>
    <link rel="stylesheet" href="./styles/theme.css">
    <link rel="stylesheet" href="./styles/product-page.css">
</head>

<body>
    <?php generateHeader(); ?>
    <main>

        <div id="product-content-container">
            <div id="product-columns">
                <div id="product-image">
                    <img src="./assets/<?php echo $product_image; ?>">
                </div>
                <div id="product-details">
                    <p id="product-name"><?php echo $product_name; ?></p>
                    <p id="product-price"><?php echo number_format((float) $product_price, 2); ?>
                        PHP/<?php echo $product_price_unit; ?></p>
                    <p id="product-description">
                        Description:<br><br>
                        <?php echo $product_description; ?>
                    </p>
                    <div id="product-quantity-controls">
                        <button id="btn-subtract-quantity">-</button>
                        <p id="product-quantity">1</p>
                        <button id="btn-add-quantity">+</button>
                    </div>
                    <div id="transaction-buttons">
                        <form method="POST" action="./product-page.php">
                            <input type="hidden" name="product-category" value="<?php echo $product_category; ?>">
                            <input type="hidden" name="product-index" value="<?php echo $product_index; ?>">
                            <input type="hidden" name="action-product-page" value="add-to-cart">
                            <button id="btn-add-to-cart" type="submit">
                                <?php echo $addToCartText; ?>
                            </button>
                        </form>
                        <form method="POST" action="./checkout.php">
                            <input type="hidden" name="action-product-page" value="buy-now">
                            <button id="btn-buy-now" type="submit">BUY NOW</button>
                        </form>
                    </div>
                    <!-- <p id="shipping-fee">Shipping Fee: 15.00 PHP</p>
                    <p id="market-location">Market Location: Quezon City</p>
                    <ul id="product-tags">
                        <li>%100 Fresh</li>
                        <li>Short time delivery</li>
                    </ul> -->
                </div>
            </div>
            <!-- <div id="product-description-container">
                <p id="product-description">
                    Description:<br>
                    This is a banana.
                </p>
            </div> -->
        </div>
        <h2>Similar Items</h2>
        <!-- <div id="similar-products-container"> -->
        <div id="similar-products">
            <?php

            $category = $_POST['product-category'];
            $excludedIndex = (int) $_POST['product-index'];

            $categoryProducts = $products[$category];
            $indices = [];

            // setCacheValue('product-page', 'indices', $indices);
            // $indices = generateSimilarItemIndices($categoryProducts, 7, $excludedIndex);
            if (
                (isset($_POST['action-product-page'])
                    && $_POST['action-product-page'] !== 'similar-item')
                // && $_SESSION['last-page'] === 'product-page'
                // && $_POST['action-product-page'] !== 'similar-item'
                && cacheValueExists('product-page', 'indices')
            ) {
                // echo var_dump(cacheValueExists('product-page', 'indices'));
                $indices = getCacheValue('product-page', 'indices');
                // echo "echoing indices";
            } else {
                // echo $excludedIndex;
                $indices = generateSimilarItemIndices($categoryProducts, 7, $excludedIndex);
                // var_dump($indices);
                setCacheValue('product-page', 'indices', $indices);
                // echo "cached indices";
                //$_SESSION['cache-product-page']['indices'];
            }

            // var_dump($indices);

            if (sizeof($indices) === 0) {
            ?>
                <p id="no-similar-items">No similar items to show.</p>
                <?php
            } else {
                for ($i = 0; $i < sizeof($indices); $i++) {
                    $product = $categoryProducts[$indices[$i]];
                ?>
                    <div class="card">
                        <form method="POST" action="./product-page.php">
                            <input type="hidden" name="product-name" value="<?php echo $product->name; ?>">
                            <input type="hidden" name="product-price" value="<?php echo $product->price; ?>">
                            <input type="hidden" name="product-image" value="<?php echo $product->image; ?>">
                            <input type="hidden" name="product-category" value="<?php echo $category; ?>">
                            <input type="hidden" name="product-index" value="<?php echo $indices[$i]; ?>"></button>
                            <input type="hidden" name="product-description" value="<?php echo $product->description; ?>">
                            <input type="hidden" name="product-price-unit" value="<?php echo $product->priceUnit; ?>">
                            <input type="hidden" name="action-product-page" value="similar-item">
                            <button class="btn-goto-product-page" type="submit">
                                <img src="./assets/<?php echo $product->image; ?>" loading="lazy">
                            </button>
                        </form>
                        <p class="name"><?php echo $product->name; ?></p>
                    </div>
            <?php }
            } ?>
            <!-- <div class="card">
                <a href="./product-page.php">
                    <img src="./assets/cucumber.jpg">
                </a>
                <p class="name">Cucumber</p>
            </div>
            <div class="card">
                <a href="./product-page.php">
                    <img src="./assets/tomato.jpg">
                </a>
                <p class="name">Tomato</p>
            </div> -->
        </div>
        <!-- </div> -->
    </main>
    <?php generateFooter(); ?>
</body>

</html>