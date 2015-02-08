<?php

namespace Controllers;
use Libraries\Router;
use Models\Event;
use Models\Comment;

class EventController extends BaseController
{
    protected $model;
    
    public function __construct(Router $route)
    {
        parent::__construct($route);
        $this->model = new Event();
    }
    
    public function getIndex()
    {
        $events = $this->model->all();
                
        if ($events != false) {
            
            $this->layout('topic/single-topic', ['title' => 'Events', 'items' => $events]);
        } else {
            // events are not found
            $this->abort();
        }
    }
    
    public function getShow($slug)
    {        
        $event = $this->model->get($slug);

        if ($event != false) {
            
            if ($this->user->can('event.attend') && $event['attendance']) {
                $event['attendances'] = $this->model->attendance($event['id']);
            }

            if ($this->user->can('event.comment') && $event['comment']) {
                $commentModel = new Comment;
                $event['comments'] = $commentModel->getFor($event['id']);
            }
            
            $this->layout('event/single-event', $event);
        } else {
            // event not found
            $this->abort();
        }
    }
    
    public function postUpdate($slug)
    {
        $event = $this->model->get($slug);
        
        if ($event != false) {
            
            $this->model->update($event, $_POST);

        } else {
            // event not found
            $this->abort();
        }
    }
    
    public function postAttendance($slug)
    {        
        $event = $this->model->get($slug);
        
        if ($event != false) {
            
            $status = filter_input(INPUT_POST, 'status');
            
            $this->model->attend($event['id'], $this->user->getId(), $status);
            
            echo 'attend';
            
        } else {
            
            // event not found
            $this->abort();
        }
    }
}