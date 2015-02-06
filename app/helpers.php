<?php

/**
 * Builds a url relative to the current path
 * @param type $path
 */
function url($path = "", $relative = false)
{
    $path = ltrim($path, '/');
    
    if ($relative) {
        return BASE_URL . CURRENT_URL . '/' . $path;
    }else{
        return BASE_URL . $path;
    }
}

function image($path, $width = false, $height = false)
{
    $path = ltrim($path, '/');
    
    return BASE_URL . 'images/' . $path;
}

function format_date($format, $date)
{
    $local = new DateTimeZone(LOCAL_TIMEZONE);
    $time = new DateTime($date, new DateTimeZone('UTC'));
    $time->setTimezone($local);
    return $time->format($format);
}

function to_sql_date($date)
{
    $local = new DateTimeZone(LOCAL_TIMEZONE);
    $time = new DateTime($date, $local);
    $time->setTimezone(new DateTimeZone('UTC'));
    return $time->format('Y-m-d H:i:s');
}