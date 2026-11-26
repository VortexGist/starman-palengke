<?php
    require_once './core/script-init.php';
    require_once "./core/script-product-page.php";
    require_once "./core/script-cart.php";

    $_SESSION['last-page'] = 'product-page';

    if (isset($_POST['product-id'])) {
        $_SESSION['product']['product-id'] = $_POST['product-id'];
    }

    $addToCartText = $_SESSION['add-to-cart']['button-content'] ?? 'ADD TO CART';

    $product = DB::getProductByID((int) $_SESSION['product']['id']);

    $buttonDisabled = '';

    if (isset($_SESSION['add-to-cart']['button-content']) && 
        $_SESSION['add-to-cart']['button-content'] === 'ADDED TO CART') {
        $buttonDisabled = 'disabled';
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
                    <img src="./assets/<?php echo $product['image']; ?>">
                </div>
                <div id="product-details">
                    <p id="product-name"><?php echo $product['name']; ?></p>
                    <p id="product-price"><?php echo number_format((float) $product['price'], 2); ?>
                        PHP/<?php echo $product['price_unit']; ?></p>
                    <p id="product-description">
                        Description:<br><br>
                        <?php echo $product['description']; ?>
                    </p>
                    <form method="POST" action="./core/action-add-to-cart.php">
                        <label for="input-product-quantity">Quantity:</label>
                        <input id="input-product-quantity" name="product-quantity" type="number" min="1" value="1">
                        <input type="hidden" name="redirect" value="product-page.php">
                        <input type="hidden" name="product-id" value="<?= $product['id'] ?>">
                        <div id="transaction-buttons">
                            <button id="btn-add-to-cart" type="submit" <?= $buttonDisabled ?>>
                                <?php echo $addToCartText; ?>
                            </button>
                            <button id="btn-buy-now" type="submit" formaction='./checkout.php'>
                                BUY NOW
                            </button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
        <h2>Similar Items</h2>
        <div id="similar-products">
            <?php
                // $category = $product['category'];
                // $categoryProducts = DB::getProducts($category);
                // $excludedIndex = -1;

                // Get index of product id
                // foreach ($categoryProducts as $rowIndex => $product) {
                //     if ($product['id'] === (int) $_POST['product-id'] ) {
                //         $excludedIndex = $rowIndex;
                //     }
                // }

                // $categoryProducts = $products[$category];
                // $indices = [];

                // var_dump($categoryProducts);

                // setCacheValue('product-page', 'indices', $indices);
                // $indices = generateSimilarItemIndices($categoryProducts, 7, $excludedIndex);
                // if (
                //     (isset($_POST['action-product-page'])
                //         && $_POST['action-product-page'] !== 'similar-item')
                //     // && $_SESSION['last-page'] === 'product-page'
                //     // && $_POST['action-product-page'] !== 'similar-item'
                //     && cacheValueExists('product-page', 'indices')
                // ) {
                //     // echo var_dump(cacheValueExists('product-page', 'indices'));
                //     $indices = getCacheValue('product-page', 'indices');
                //     // echo "echoing indices";
                // } else {
                //     // echo $excludedIndex;
                //     $indices = generateSimilarItemIndices($categoryProducts, 7, $excludedIndex);
                //     // var_dump($indices);
                //     setCacheValue('product-page', 'indices', $indices);
                //     // echo "cached indices";
                //     //$_SESSION['cache-product-page']['indices'];
                // }

                // var_dump($indices);

                // var_dump($categoryProducts);

                $productsIDs = $_SESSION['similar-products'];

                // if (!isset($_SESSION['similar-products'])) {
                //     $category = $product['category'];
                //     $categoryProducts = DB::getProducts($category);
                //     $excludedID = $product['id'];
                //     $productsIDs = generateSimilarItemIDs($categoryProducts, 7, $excludedID);
                // } else {
                //     $productsIDs = $_SESSION['similar-products'];
                // }

                if (sizeof($productsIDs) === 0) {
                ?>
                    <p id="no-similar-items">No similar items to show.</p>
                <?php
                } else {
                    // Fetch similar products
                    // $similarProducts = DB::getProducts($_SESSION['product']['category']);

                    for ($i = 0; $i < sizeof($productsIDs); $i++) {
                        $similarProduct = DB::getProductByID($productsIDs[$i]);
                        // var_dump($similarProduct);
                    ?>
                    <div class="card">
                        <form method="POST" action="./core/action-generate-similar-products.php">
                            <input type="hidden" name="product-id" value="<?= $similarProduct['id'] ?>">
                            <input type="hidden" name="product-category" value="<?= $similarProduct['category'] ?>">

                            <!-- <input type="hidden" name="action-product-page" value="similar-item"> -->

                            <button class="btn-goto-product-page" type="submit">
                                <img src="./assets/<?php echo $similarProduct['image']; ?>" loading="lazy">
                            </button>
                        </form>
                        <p class="name"><?php echo $similarProduct['name']; ?></p>
                    </div>
                    <?php 
                    }
                }?>
        </div>
    </main>
    <?php generateFooter(); ?>
</body>

</html>