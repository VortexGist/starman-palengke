<?php
require_once './../core/script-page-gen.php';
// require_once './../core/script-products.php';
require_once './../core/script-util.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Grounds | Starman Palengke</title>
    <link rel="stylesheet" href="./../styles/theme.css">
    <link rel="stylesheet" href="./../styles/products.css">
    <style>
        form {
            width: fit-content;
            height: fit-content;
        }
    </style>
</head>

<body>
    <?php
    foreach ($products as $id => $product) {
        ?>
        <div class="flex">
            <div class="card">
                <a href="./product-page.php">
                    <img src="./../<?php echo $product['image']; ?>">
                </a>
                <p class="name"><?php echo $product['name']; ?></p>
                <p class="price"><?php echo number_format($product['price'], 2); ?> PHP/kg</p>
                <form method="post" action="cart.php">
                    <input type="hidden" name="product-name" value="<?= $product['name'] ?>">
                    <input type="hidden" name="product-price" value="<?= $product['price'] ?>">
                    <button class="btn-add-to-cart" type="submit">ADD TO CART</button>
                </form>
            </div>
        </div>
    <?php } ?>
</body>

</html>