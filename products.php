<?php
require_once './core/script-init.php';
    // require_once './core/script-page-gen.php';
    // // require_once './core/script-products.php';
    // require_once './core/script-util.php';
    // require_once './core/script-session.php';
    // require_once './core/script-db.php';

    $_SESSION['last-page'] = 'products';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products | Starman Palengke</title>
    <link rel="stylesheet" href="./styles/theme.css">
    <link rel="stylesheet" href="./styles/products.css">
</head>

<body>
    <?php generateHeader(); ?>
    <main>
        <h1>Products</h1>
        <ul id="categories">
            <?php
                $categories = DB::getProductCategories();

                // var_dump($categories);
                foreach ($categories as $id => $row) {
                ?>
                <!-- foreach ($products as $productCategoryName => $productCategory) { ?> -->
                <li>
                    <form method="post" action="./products.php">
                        <input type="hidden" name="product-category" value="<?php echo $row['category'] ?>">
                        <button class="btn-change-category"
                            type="submit"><?php echo ucwords($row['category']); ?></button>
                    </form>
                </li>
            <?php }?>
        </ul>
        <?php
            $category = 'meat';
            if (isset($_POST['product-category'])) {
                $category = $_POST['product-category'];
            }
        ?>
        <h2><?php echo ucwords($category); ?></h2>
        <div class="flex centered product-box">
            <?php
                $products = DB::getProducts($category);
                // var_dump($products);
                foreach ($products as $id => $product) {
                    // var_dump($product['id']);
                ?>
                <div class="card">
                    <form method="POST" action="./core/action-generate-similar-products.php">
                        <input type="hidden" name="product-id" value="<?php echo $product['id']; ?>">
                        <input type="hidden" name="product-category" value="<?php echo $product['category']; ?>">
                        <!-- <input type="hidden" name="product-price" value="<?php echo $product->price; ?>">
                        <input type="hidden" name="product-image" value="<?php echo $product->image; ?>">
                        <input type="hidden" name="product-category" value="<?php echo $category; ?>">
                        <input type="hidden" name="product-price-unit" value="<?php echo $product->priceUnit; ?>">
                        <input type="hidden" name="product-index" value="<?php echo $id; ?>">
                        <input type="hidden" name="product-description" value="<?php echo $product->description; ?>"> -->
                        <button class="btn-goto-product-page" type="submit">
                            <img src="./assets/<?php echo $product['image']; ?>" loading="lazy">
                        </button>
                    </form>
                    <p class="name"><?php echo $product['name']; ?></p>
                    <p class="price"><?php echo number_format($product['price'], 2); ?> PHP/<?php echo $product['price_unit']; ?>
                    </p>
                    <form method="POST" action="./core/action-add-to-cart.php">
                        <input type="hidden" name="product-id" value="<?php echo $product['id']; ?>">
                        <!-- <input type="hidden" name="product-name" value="<?php echo $product->name; ?>">
                        <input type="hidden" name="product-price" value="<?php echo $product->price; ?>">
                        <input type="hidden" name="product-category" value="<?php echo $category; ?>">
                        <input type="hidden" name="product-index" value="<?php echo $id; ?>"> -->
                        <input type="hidden" name="action-products" value="add-to-cart">
                        <button class="btn-add-to-cart" type="submit">ADD TO CART</button>
                    </form>
                </div>
            <?php }?>
        </div>
    </main>
    <?php generateFooter(); ?>
</body>

</html>