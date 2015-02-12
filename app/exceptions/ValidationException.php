<?php

namespace Exceptions;
use Exception;

class ValidationException extends Exception
{
    
    public function __construct($field, $value, $reason = null)
    {
        $message = "'$value' does not validate for '$field'";
        if (!is_null($reason)) {
            $message .= ', ' . $reason;
        }
        parent::__construct($message);
    }
}