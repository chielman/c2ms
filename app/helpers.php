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
        
        return path_to_url( $path );
    }
}

function format_date($format, $date)
{
    if ($format == 'x') {
        
        $now    = new DateTime();
        $now    = $now->format('U');
        $time   = $now - $date->format('U');
        
        if ($time < 60) { return 'net'; }
        if ($time < 3600) { return round($time / 60) . ' min'; }
        if ($time < 86400) { return round($time / 3600) . ' uur'; }
        if ($time < 172800) { return 'gisteren om '; }
        if ($time < 604800) { return round($time / 86400) . ' dagen'; }
        if ($time < 2592000) { return round($time / 604800) . ' weken'; }
        if ($time < 31536000) { return round($time / 2592000) . ' maanden'; }
        return round($time / 31536000) . ' jaar';
        
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