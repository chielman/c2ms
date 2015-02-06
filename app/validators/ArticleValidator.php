<?php

namespace Validators;

class ArticleValidator extends BaseValidator
{
    protected $rules = [
        'title'     => ['mode' => 'plain-single'],
        'slug'      => ['mode' => 'regex', 'options' => 'a-z0-9-'],
        'content'   => ['mode' => 'html'],
        'comment'   => ['mode' => 'boolean']
    ];
}