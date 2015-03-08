<?php
include('../app/bootstrap.php');

// remove filename from php_self
define('BASE_URL', rtrim($_SERVER['PHP_SELF'], 'index.php'));

$url    = substr($_SERVER['REQUEST_URI'], strlen(BASE_URL) );
$query  = parse_url($url);

$path   = isset($query['path']) ? $query['path'] : '';

if (isset($query['query'])) {
    parse_str( $query['query'] , $_GET);
}

define('CURRENT_URL', $path );

// load routes
include(APP_PATH . '/route.php');