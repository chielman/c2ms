<?php

// define paths
define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app' );
define('PUBLIC_PATH',  BASE_PATH . '/public' );

// register classloader
require(APP_PATH . '/libraries/ClassLoader.php');
$classLoader = new Libraries\ClassLoader();
$classLoader->register();

// start session
session_start();

// set time zones
define('LOCAL_TIMEZONE', 'Europe/Amsterdam');

include(APP_PATH . '/helpers.php');

use Libraries\IoC;
use \PDO;

IoC::singleton('database', function(){ 
    $db = new PDO('mysql:host=localhost;dbname=c2ms', 'root', '', [PDO::ATTR_PERSISTENT => true]); 
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $db;
});
IoC::singleton('notify', function(){
    return new Libraries\Notify();
});
IoC::singleton('current-user', function(){
    return new Libraries\CurrentUser();
});