<?php

function loadLocalEnvironment($filepath)
{
    if (! file_exists($filepath)) {
        // die('.env file not found');
        return;
    }

    $lines = file($filepath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        // skip comments
        if (strpos(trim($line), '#') === 0) {
            continue;
        }

        list($key, $value) = explode('=', $line, 2);
        $_ENV[trim($key)]  = trim($value);
    }
}

loadLocalEnvironment(__DIR__ . '/../.env');