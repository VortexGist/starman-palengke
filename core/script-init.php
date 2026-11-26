<?php

$folder = 'starman-palengke/';
if ($_SERVER['DOCUMENT_ROOT'] === '/') {
	$folder = '';

	// environment means live hosting
	ini_set("display_errors", 0);
	ini_set("log_errors", 1);
	// ini_set("display_startup_errors", 1);
	error_reporting(E_ALL);
} else {
	// environment means development
	ini_set("display_errors", 1);
	error_reporting(E_ALL);
}

define('PROJECT_FOLDER', $folder);

// Load scripts
require_once __DIR__ . '/script-classes.php';
require_once __DIR__ . '/script-session.php';
require_once __DIR__ . '/script-page-gen.php';

// Load local environment if any
include_once __DIR__ . '/script-env.php';

// Initialize database
DB::init();

// Initialize session
session_start();