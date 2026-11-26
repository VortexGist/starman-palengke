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
        <div id="title-container"> 
            <img id="logo" src="./assets/logo.png">
            <h1 id="title">Starman Palengke</h1>
        </div>
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
