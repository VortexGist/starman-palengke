<?php

function generateHeader() {
    echo "<header>";
    echo "<div class=\"flex\">";
    echo "<nav>";
    echo "    <ul>";
    echo "        <li><a href=\"./index.php\">Home</a></li>";
    echo "        <li><a href=\"./about.php\">About</a></li>";
    echo "        <li><a href=\"./products.php\">Products</a></li>";
    echo "        <li><a href=\"./cart.php\">Cart</a></li>";
    echo "    </ul>";
    echo "</nav>";
    echo "<h1 id=\"title\">Starman Palengke</h1>";
    echo "</div>";
    echo "</header>";
}

function generateFooter() {
    echo "<footer><p class=\"copyright\">&#169;2026 Calisura & Francisco. All rights reserved.</p></footer>";
}