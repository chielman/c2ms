<?php

namespace Libraries;
use Closure;

class IoC
{
    protected static $registry = [];
    protected static $singletons = [];
    
    public static function register($name, Closure $resolve)
    {
        static::$registry[$name] = $resolve;
    }
    
    public static function singleton($name, Closure $resolve)
    {
        $singletons =& static::$singletons;
        
        static::$registry[$name] = function() use ($name, $resolve, &$singletons){
            
            if (!array_key_exists($name, $singletons)) {
                $singletons[$name] = $resolve();
            }
            
            return $singletons[$name];
        };
    }
    
    public static function resolve($name)
    {
        if (static::registered($name)) {
            $name = static::$registry[$name];
            return $name();
        }
    }
    
    public static function registered($name)
    {
        return isset(static::$registry[$name]);
    }
}