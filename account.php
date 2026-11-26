<?php
    require_once './core/script-init.php';

    $_SESSION['last-page'] = 'account';

   
    if (isset($_SESSION['error']['message'])) {
        echo $_SESSION['error']['message'];
    }

    if (isset($_SESSION['success']['message'])) {
        echo $_SESSION['success']['message'];
    }

    if (isset($_SESSION["user"])) {
        
    }
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
            <?php 
            if (isset($_SESSION['user'])) {
            ?>
                <form method="POST" action="./core/action-logout.php">
                    <button type="submit">
                        LOGOUT
                    </button>
                </form>
            <?php
            } else {
            ?>
                <p>You do not have an account yet. Click <a href="./signup.php">here</a> to create one</p>
            <?php
            }
            ?>
            
        </div>
    </main>
    <?php generateFooter(); ?>
</body>

</html>