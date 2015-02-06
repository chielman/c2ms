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

function path_to_url($path)
{
    $url = str_replace(PUBLIC_PATH, '', $path);
    return BASE_URL . $url;
}

function image($path, $width = false, $height = false)
{
    $path = PUBLIC_PATH . '/images/' . ltrim($path, '/');
    
    if ($width !== false || $height !== false) {
        
        $lib = new Libraries\Image();
        return path_to_url( $lib->resize($path, $width, $height) );
        
    } else {
        
        return BASE_URL . 'images/' .  $path;
    }
}

function format_date($format, $date)
{
    if ($format == 'x') {
        
        $now    = new DateTime();
        $now    = $now->format('U');
        $time   = $now - $date->format('U');
        
        if ($time < 60) { return ''; }
        $time = $time / 60; // to minutes
        if ($time < 60) { return round($time) . ' min'; }
        $time = $time / 60; // to hours
        if ($time < 24) { return round($time) . ' uur'; }
        $time = $time / 24; // to days
        if ($time < 2) { return 'gisteren'; }
        if ($time < 7) { return round($time) . ' dagen'; }
        if ($time < 30) { return round($time / 7) . ' weken'; }
        $time = $time / 30;
        if ($time < 12) { return round($time) . ' maanden'; }
        return round($time / 12) . ' jaar';
        
    } else {
        return $date->format($format);
    }
}

function from_sql_date($date)
{
    $local = new DateTimeZone(LOCAL_TIMEZONE);
    $time = new DateTime($date, new DateTimeZone('UTC'));
    $time->setTimezone($local);
    return $time;
}

function to_sql_date($date)
{
    $local = new DateTimeZone(LOCAL_TIMEZONE);
    $time = new DateTime($date, $local);
    $time->setTimezone(new DateTimeZone('UTC'));
    return $time->format('Y-m-d H:i:s');
}