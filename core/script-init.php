<?php

// Load scripts
require_once './core/script-page-gen.php';
require_once './core/script-classes.php';
require_once './core/script-session.php';

// Load local environment if any
include_once './core/script-env.php';

// Initialize database
DB::init();

// Initialize session
session_start();