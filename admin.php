<?php
    require_once './core/script-init.php';
    // require_once './core/script-page-gen.php';
    // require_once './core/script-session.php';
    // require_once './core/script-db.php';

    $_SESSION['last-page'] = 'admin';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Starman Palengke</title>
    <link rel="stylesheet" href="./styles/theme.css">
</head>

<body>
    <?php generateHeader(); ?>
    <main>
        <h1>Starman Admin</h1>
        <h2>Inventory</h2>
        <div>
            <?php

                $products = DB::getProducts();

                foreach ($products as $id => $product) {
                ?>
                <div>
                    <p><?php echo $id ?></p>
                    <p><?php echo $product['name'] ?></p>
                    <p><?php echo $product['price'] ?></p>
                    <p><?php echo $product['price_unit'] ?></p>
                    <p><?php echo $product['category'] ?></p>
                    <p><?php echo $product['description'] ?></p>
                    <p><?php echo $product['image'] ?></p>
                </div>
                <?php
                }?>
        </div>
        <h2>Registered Accounts</h2>
        <div>
            <p>Accounts Here</p>
        </div>
        <h2>Pending Orders</h2>
        <form method="POST" action="./orders.php">
            <button type="submit">Check Pending Orders</button>
        </form>
    </main>
    <?php generateFooter(); ?>
</body>

</html>