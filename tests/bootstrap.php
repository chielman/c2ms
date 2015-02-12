<?php

// define paths
define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app' );
define('PUBLIC_PATH',  BASE_PATH . '/public' );

// PHPUnit loader
spl_autoload_register(function($className){
    
    if (strpos($className, '_') !== false) {

        $classPath = join(DIRECTORY_SEPARATOR, explode($className, '_'));
        
        if (file_exists($classPath)) {
            require($classPath . '.php');
            return true;
        }
    }    
    
    return false;
    
}, true);

// register classloader
require(APP_PATH . '/libraries/ClassLoader.php');
$classLoader = new Libraries\ClassLoader();
$classLoader->register();
//Libraries\ClassLoader::register();

// start session
session_start();

// set time zones
define('LOCAL_TIMEZONE', 'Europe/Amsterdam');

include(APP_PATH . '/helpers.php');