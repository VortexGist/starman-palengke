<?php
require_once './core/script-init.php';
    // require_once './core/script-page-gen.php';
    // require_once './core/script-session.php';

    $_SESSION['last-page'] = 'orders';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Starman Palengke</title>
    <link rel="stylesheet" href="./styles/theme.css">
</head>

<body>
    <?php generateHeader(); ?>
    <main>
        <h1>Pending Orders</h1>
        <?php
            
        ?>
    </main>
    <?php generateFooter(); ?>
</body>

</html>