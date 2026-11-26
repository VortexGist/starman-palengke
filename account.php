<?php
    require_once './core/script-init.php';

    $_SESSION['last-page'] = 'account';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account | Starman Palengke</title>
    <link rel="stylesheet" href="./styles/theme.css">
</head>

<body>
    <?php generateHeader(); ?>
    <main>
        <h1>Your Account</h1>
        <div>
            <p>You do not have an account yet. Click <a href="./signup.php">here</a> to create one</p>
        </div>
    </main>
    <?php generateFooter(); ?>
</body>

</html>