<?php
include('../app/bootstrap.php');

// remove filename from php_self
define('BASE_URL', rtrim($_SERVER['PHP_SELF'], 'index.php'));
define('CURRENT_URL', substr($_SERVER['REQUEST_URI'], strlen(BASE_URL) ) );

// load routes
include(APP_PATH . '/route.php');