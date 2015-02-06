<?php

namespace Validators;
use Exceptions\ValidationException;

abstract class BaseValidator
{
    protected $rules = [];
    
    public function validate($inputs)
    {
        foreach ($inputs as $key => $input) {
            
            if (!isset($this->rules[$key])) { continue; }
            
            $rule = $this->rules[$key];
            
            $params[$key] = $this->validateSingle($key, $input, $rule);
        }
        
        return $params;
    }
    
    protected function validateSingle($key, $input, $rule)
    {
        switch ($rule['mode']) {
            
            case 'plain-single':
                $var = $input;
                break;
            
            case 'html':
                $var = $input;
                break;
            
            case 'datetime':
                $var = $input;
                break;
            
            case 'slug':
                $var = filter_var($input, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => 'a-z0-9-']]);
                if ($var === false) { throw new ValidationException($key, $input); }
                break;
            
            case 'regex':
                $var = filter_var($input, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => $rule['options']]]);
                if ($var === false) { throw new ValidationException($key, $input); }
                
            case 'boolean':
                
                $var = filter_var($input, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
                if (is_null($var)) { throw new ValidationException($key, $input); }
        }
        
        return $var;
    }
}