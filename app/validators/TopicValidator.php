<?php

namespace Validators;

class TopicValidator extends BaseValidator
{
    protected $rules = [
        'title'     => ['mode' => 'plain-single'],
        'slug'      => ['mode' => 'slug', 'not' => ['login', 'logout', 'articles', 'events', 'me', 'users', 'groups', 'topics']],
        'category'  => ['mode' => 'boolean']
    ];
}