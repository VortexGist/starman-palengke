<?php

function clearSession() {
    setcookie(session_name(), '');
}

function setCacheValue(string $page, string $name, mixed $value)
{
    // echo "cached $page-$name";
    $_SESSION["cache-$page-$name"] = $value;
}

function deleteCache(string $page, string $name)
{
    unset($_SESSION["cache-$page-$name"]);
}

function getCacheValue(string $page, string $name)
{
    if (isset($_SESSION["cache-$page-$name"])) {
        return $_SESSION["cache-$page-$name"];
    } else {
        return null;
    }
}

function cacheValueExists(string $page, string $name): bool
{
    return isset($_SESSION["cache-$page-$name"]);
}

function getActionValue(string $page)
{
    if (isset($_POST["cache-$page"])) {
        return $_POST["cache-$page"];
    } else {
        return null;
    }
}