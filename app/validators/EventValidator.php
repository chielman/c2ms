<?php

namespace Validators;

class EventValidator extends BaseValidator
{
    protected $rules = [ 
        'slug'          => ['mode' => 'slug'],
        'title'         => ['mode' => 'plain-single'],
        'description'   => ['mode' => 'html'],
        'start'         => ['mode' => 'datetime'],
        'end'           => ['mode' => 'datetime'],
        'fullday'       => ['mode' => 'boolean'],
        'attendance'    => ['mode' => 'boolean'],
        'attend_end'    => ['mode' => 'datetime'],
        'comment'       => ['mode' => 'datetime']
    ];
}