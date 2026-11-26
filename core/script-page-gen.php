<?php

function generateHeader()
{
?>
    <header>
        <div class="flex">
            <nav>
                <ul>
                    <li><a href="./index.php">Home</a></li>
                    <li><a href="./about.php">About</a></li>
                    <li><a href="./products.php">Products</a></li>
                    <li><a href="./cart.php">Cart</a></li>
                </ul>
            </nav>
            <p id="user">
            <?php 
                if (isset($_SESSION['user'])) {
                    echo 'Welcome,  '. $_SESSION['user']['name'];
                } else {
                    echo 'Not signed in';
                }
            ?>        
            </p>
            <img id="logo" src="./assets/logo.png">
            <h1 id="title">Starman Palengke</h1>
        </div>
    </header>
<?php
}

function generateFooter()
{
?>
    <footer>
        <p class="copyright">&#169;2026 Calisura & Francisco. All rights reserved.</p>
    </footer>
<?php
}
