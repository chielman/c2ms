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
        $access = [];
        if ($this->user->can('article.view')) { $access[] = 'article'; }
        if ($this->user->can('event.view')) { $access[] = 'event'; }
        if ($this->user->can('comment.view')) { $access[] = 'comment'; }
        
        $timeline = $this->model->getItems($access);
        $this->layout('topic/single-topic', ['title' => 'The Dutch Dragons', 'items' => $timeline]);
    }
    
}