<?php

namespace Validators;

class ArticleValidator extends BaseValidator
{
    protected $rules = [
        'title'     => ['mode' => 'plain-single'],
        'slug'      => ['mode' => 'slug'],
        'content'   => ['mode' => 'html'],
        'comment'   => ['mode' => 'boolean']
    ];
}