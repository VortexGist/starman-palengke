<?php

// define('PROJECT_FOLDER', 'starman-palengke');

// if ()

$folder = 'starman-palengke';
if ($_SERVER['DOCUMENT_ROOT'] === '/') {
	$folder = '';
}

define('PROJECT_FOLDER', $folder);

// Load scripts
require_once __DIR__ . '/script-page-gen.php';
require_once __DIR__ . '/script-classes.php';
require_once __DIR__ . '/script-session.php';

// Load local environment if any
include_once __DIR__ . '/script-env.php';

// Initialize database
DB::init();

// Initialize session
session_start();