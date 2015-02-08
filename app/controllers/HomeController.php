<?php

namespace Controllers;
use Models\Topic;
use Libraries\Router;

class HomeController extends BaseController
{
    protected $model;
    
    public function __construct(Router $route)
    {
        parent::__construct($route);
        $this->model = new Topic();
    }
    
    public function getIndex()
    {
        $timeline = $this->model->getItems();
        $this->layout('topic/single-topic', ['title' => 'The Dutch Dragons', 'items' => $timeline]);
    }
    
}