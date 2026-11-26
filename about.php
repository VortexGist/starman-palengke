<?php
require_once './core/script-init.php';
// require_once "./core/script-page-gen.php";
// require_once "./core/script-session.php";

$_SESSION['last-page'] = 'about';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us | Starman Palengke</title>
    <link rel="stylesheet" href="./styles/theme.css">
    <style>
        .content-box {
            background-color: var(--theme-color-primary);
            border: 1px solid black;
            width: 80%;
            margin: auto;
            opacity: 0.9;
        }

        .content-box p {
            margin-left: 2rem;
            margin-right: 2rem;
            text-align: justify;
            text-indent: 4rem;
        }

        section h2 {
            margin-left: 2rem;
            text-align: justify;
        }

        section#authors h3 {
            text-align: center;
        }

        #authors p {
            text-align: center;
            text-indent: 0px;
        }

        #authors img {
            border: 1px solid black;
            width: 300px;
            height: 300px;
        }

        .image-container {
            width: fit-content;
            margin: auto;
        }

        #authors .flex {
            justify-content: center;
            margin: auto;
        }

        #authors .flex,
        .author {
            background-color: transparent;
        }
    </style>
</head>

<body>
    <?php generateHeader(); ?>
    <main>
        <h1>About Us</h1>
        <div class="content-box">
            <section id="lore">
                <h2>About Us</h2>
                <p>
                    Starman Palengke. The palengke originated as a small local market for just everyday neccessities. As
                    time
                    passed, the locals who were seeking to earn some cash decided also to sell daily necessities. That
                    us
                    how
                    the market came to be as it is now.
                    The local market is located at Quezon City where everyday locals always go to get necessities. The
                    local
                    citizens who sells in the market sells items/foods that are general or necessary for everyday use —
                    generally to any other local markets.
                </p>
                <p>
                    People go here everyday to shop mostly for the fresh foods, the cheap prices per kilo, and of course
                    for
                    the
                    daily necessity. The palengke consists of what you generally see at most; Vegetables, Fruits,
                    Fishes,
                    Poultry, Eggs, Grains and Rice, etc...
                    The things sold at the palengke are sold at fair prices. Everything sold at Starman Palengke is made
                    sure
                    that everything is fresh.
                    Why don't you come and try shopping with us!
                </p>
            </section>

            <section id="authors">
                <h2>Authors</h2>
                <div class="flex">
                    <div class="author">
                        <div class="image-container">
                            <img src="./assets/author-calisura.jpg">
                        </div>
                        <h3>Daniel Derrick M. Calisura</h3>
                        <p>The lead programmer of the website.</p>
                    </div>
                    <div class="author">
                        <div class="image-container">
                            <img src="./assets/author-francisco.jpg">
                        </div>
                        <h3>Lorrenz Pio F. Francisco</h3>
                        <p>The lead designer and content creator of the website.</p>
                    </div>
                </div>
            </section>
        </div>
    </main>
    <?php generateFooter(); ?>
</body>

</html>