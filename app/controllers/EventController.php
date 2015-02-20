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
        $topics = $this->user->rights('event.view');
        if (in_array(null, $topics)) { 
            $topics = null;
        }
        
        $events = $this->model->all( $topics );
                
        if ($events !== false) {
            
            if (count($events) > 0) {
                $this->layout('topic/single-topic', ['title' => 'Events', 'items' => $events]);
            } else {
                // prevent being indexed
                header('X-Robots-Tag: noindex');
                $this->addMeta('robots', 'noindex');
                $this->layout('topic/empty-topic', ['title' => 'Events']);
            }
            
        } else {
            // events are not found
            $this->abort();
        }
    }
    
    public function getShow($slug)
    {        
        $event = $this->model->get($slug);

        if (!$this->user->can('event.view', $event['cat_id'])) {
            $this->unauthorized();
        }
        
        if ($event != false) {
            
            if ($this->user->can('event.attend') && $event['attendance']) {
                $event['attendances'] = $this->model->attendance($event['id']);
            }

            if ($this->user->can('event.comment') && $event['comment']) {
                $commentModel = new Comment;
                $event['comments'] = $commentModel->getFor($event['id']);
            }
            
            $this->setTitle($event['title']);
            //$this->addMeta('keywords', '');
            //$this->addMeta('description', '');
            
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
            
            if (!$this->user->can('event.edit')) {
                $this->unauthorized();
            }
            
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
            
            if (!$this->user->can('event.attend')) {
                $this->unauthorized();
            }
            
            $status = filter_input(INPUT_POST, 'status');
            
            $this->model->attend($event['id'], $this->user->getId(), $status);
            
            echo 'attend';
            
        } else {
            
            // event not found
            $this->abort();
        }
    }
}