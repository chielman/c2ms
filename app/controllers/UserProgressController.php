<?php

namespace Controllers;

use Libraries\Router;
use Models\UserProgress;
use Models\User;

class UserProgressController extends BaseController
{
    /**
     * @var \Models\UserProgress
     */
    protected $model;
    
    public function __construct(Router $route)
    {
        parent::__construct($route);
        $this->model = new UserProgress();
    }
    
    /**
     * Show a list of all users and their current progress
     */
    public function getIndex()
    {
        if ($this->user->can('userprogress.view')) {
            
            $data = $this->model->all();
            
            $this->layout('userprogress/list', ['users' => $data]);
            
        } else {
            $this->unauthorized();
        }
    }
    
    /**
     * Show the progress for a single user
     */
    public function getShow($slug = null)
    {
        $userModel = new User();
        
        if ($slug == null) {
            $slug = $this->user->getId();
            $user = $userModel->get($slug);
        } else {
            $user = $userModel->getByName($slug);
            $slug = $user['id'];
        }
        
        if ($this->user->can('userprogress.create')) {
            $reportTypes = $this->model->getReports();
        } else {
            $reportTypes = [];
        }
        
        if ($this->user->can('userprogress.view') || $this->user->can('self.userprogress.view') && $slug == $this->user->getId()) {
            $data = $this->model->getByUser($slug);
            $this->layout('userprogress/single-user', ['user' => $user, 'reports' => $data, 'reportTypes' => $reportTypes]);
        } else {
            $this->unauthorized();
        }
    }
    
    public function getForm()
    {
        $type = filter_input(INPUT_POST, 'type');
        var_dump($type);
    }
}