<?php

namespace Controllers;
use Models\Home;
use Libraries\Router;

class HomeController extends BaseController
{
    protected $model;
    
    public function __construct(Router $route)
    {
        parent::__construct($route);
        $this->model = new Home();
    }
    
    public function getIndex()
    {
        $timeline = $this->model->all();
        $this->layout('topic/single-topic', ['title' => 'The Dutch Dragons', 'items' => $timeline]);
    }
    
}