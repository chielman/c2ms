<?php

namespace Libraries;

class ClassLoader
{   
    public function load($className)
    {
        $classPath  = APP_PATH . '/' . $className . '.php';
        $success    = false;
        
        if (file_exists($classPath)) {
            require($classPath);
            $success = true;
        }
        
        return $success;
    }
    
    public function register()
    {
        spl_autoload_register([$this, 'load'], true);
    }
}