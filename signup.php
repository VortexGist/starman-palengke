<?php
    require_once './core/script-init.php';

    $_SESSION['last-page'] = 'signup';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup | Starman Palengke</title>
    <link rel="stylesheet" href="./styles/theme.css">
    <style>
        #form-container {
            /*background-color: var(--theme-color-primary);*/
            background: url("./assets/texture-wood.jpg");
            width: 50%;
            margin: auto;
            padding: 2rem;
            border: 5px solid var(--theme-color-secondary);
        }

        form input {
            width: 80%;
            display: block;
            margin: auto;
            padding: 0.5rem 0.5rem;
            margin-top: 2rem;
        }

        form button {
            background-color: var(--theme-color-primary);
            border: 1px solid black;
            padding: 0.8rem 0.5rem;
            margin: auto;
            display: block;
            min-width: 120px;
            margin-top: 1rem;
        }
    </style>
</head>

<body>
    <?php generateHeader(); ?>
    <main>
        <div id="form-container">
            <h1>Create Starman Account</h1>
            <form method="POST" action="./action-signup.php">
                <input id="input-user-name" type="text" name="user-name" placeholder="Create username">
                <input id="input-user-password" type="password" name="user-password" placeholder="Create password">
                <input id="input-user-confirm-password" type="password" name="user-confirm-password" placeholder="Confirm password">
                <button type="submit">CREATE ACCOUNT</button>
            </form>
        </div>
    </main>
    <?php generateFooter(); ?>
</body>

</html>