<?php
require_once './core/script-page-gen.php';
require_once './core/script-session.php';

$_SESSION['last-page'] = 'index';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Starman Palengke</title>
    <link rel="stylesheet" href="./styles/theme.css">
    <link rel="stylesheet" href="./styles/index.css">
</head>

<body>
    <?php generateHeader(); ?>
    <main>
        <h1>Welcome to Starman!</h1>
        <div id="product-branches" class="texture-wood">
            <h2 class="heading">Browse the Palengke</h2>
            <div class="flex">
                <div class="card">
                    <a href="./products.php#fruits">
                        <img src="./assets/banana.jpg">
                    </a>
                    <h3 class="name">Fruits</h3>
                </div>
                <div class="card">
                    <a href="./products.php#vegetables">
                        <img src="./assets/chayote.jpg">
                    </a>
                    <h3 class="name">Vegetables</h3>
                </div>
                <div class="card">
                    <a href="./products.php#meat">
                        <img src="./assets/pork.jpg">
                    </a>
                    <h3 class="name">Meat</h3>
                </div>
                <div class="card">
                    <a href="./products.php#grains">
                        <img src="./assets/rice.jpg">
                    </a>
                    <h3 class="name">Grains</h3>
                </div>
                <div class="card">
                    <a href="./products.php#poultry">
                        <img src="./assets/chicken.jpg">
                    </a>
                    <h3 class="name">Poultry</h3>
                </div>
            </div>
        </div>
    </main>
    <?php generateFooter(); ?>
</body>

</html>