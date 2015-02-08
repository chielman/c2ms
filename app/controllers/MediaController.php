<?php

namespace Controllers;
use Libraries\Router;
use Models\Media;

class MediaController extends BaseController
{
    public function __construct(Router $route) {
        parent::__construct($route);
    }
}