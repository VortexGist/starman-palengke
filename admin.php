<?php
    require_once './core/script-init.php';

    $_SESSION['last-page'] = 'admin';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Starman Palengke</title>
    <link rel="stylesheet" href="./styles/theme.css">
    <link rel="stylesheet" href="./styles/admin.css">
</head>

<body>
    <?php generateHeader(); ?>
    <main>
        <h1>Starman Admin</h1>
        <h2>Inventory</h2>
        <div class="table-container">
            <table id="table-inventory">
                <tr>
                    <th>id</th>
                    <th>name</th>
                    <th>price</th>
                    <th>price_unit</th>
                    <th>category</th>
                    <th>quantity</th>
                    <th>description</th>
                    <th>image</th>
                </tr>
                <?php
                    $products = DB::getProducts(null);
                    
                    foreach ($products as $id => $product) {
                    ?>
                    <tr>
                        <td><?php echo $id ?></td>
                        <td><?php echo $product['name'] ?></td>
                        <td><?php echo $product['price'] ?></td>
                        <td><?php echo $product['price_unit'] ?></td>
                        <td><?php echo $product['category'] ?></td>
                        <td><?php echo $product['quantity'] ?></td>
                        <td><?php echo $product['description'] ?></td>
                        <td><?php echo $product['image'] ?></td>
                    </tr>
                    <?php
                    }?>
            </table>
        </div>
        <h2>Registered Accounts</h2>
        <div class="table-container">
            <table id="table-inventory">
                <tr>
                    <th>id</th>
                    <th>username</th>
                    <th>password</th>
                    <th>role</th>
                </tr>
            <?php
                $accounts = DB::getAccounts();
                foreach ($accounts as $id => $account) {
                ?>
                <tr>
                    <td><?php echo $id ?></td>
                    <td><?php echo $account['username'] ?></td>
                    <td><?php echo $account['password'] ?></td>
                    <td><?php echo $account['role'] ?></td>
                </tr>
                <?php
                }?>
            </table>
        </div>
        <h2>Pending Orders</h2>
        <form method="POST" action="./orders.php">
            <button type="submit">Check Pending Orders</button>
        </form>
    </main>
    <?php generateFooter(); ?>
</body>

</html>