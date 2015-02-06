<?php

namespace Exceptions;
use Exception;

class ValidationException extends Exception
{
    public function __construct($field, $value)
    {
        $message = "'$value' does not validate for '$field'";
        parent::__construct($message);
    }
}