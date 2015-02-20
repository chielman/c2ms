<?php

namespace Controllers;
use Libraries\Router;
use Libraries\IoC;

abstract class BaseController
{
    protected $arguments;
    protected $meta = [];
    protected $title = '';
    
    protected $user;
    protected $router;
    
    public function __construct(Router $route)
    {
        $this->user         = IoC::resolve('current-user');
        $this->router       = $route;
        ;
    }
    /**
     * Load view with optional arguments
     * 
     * @param type $view
     * @param type $args
     * @param type $return
     */
    protected function view($view, $args = [], $return = false)
    {        
        extract($args);
        
        ob_start();
        
        include(APP_PATH . '/views/' . $view . '.php');
        
        if ($return) {
            return ob_get_clean();
        } else {
            if (ob_get_level() > 1) {
                echo ob_get_clean();
            } else {
                return ob_flush();
            }
        }
    }
    
    public function attach($arguments)
    {
        $this->arguments = array_merge($this->arguments, $arguments);
    }
    
    public function __get($name) {
        return $this->arguments[$name];
    }
        
    protected function layout($view, $args = [], $return = false)
    {
        $content = $this->view($view, $args, true);
        return $this->view('layout', [
            'content' => $content, 
            'breadcrumbs' => $this->router->getCrumbs(),
            'meta' => $this->meta,
            'title' => $this->title,
            'description' => $this->description,
            'keywords' => $this->keywords
        ], $return);
        
    }
    
    protected function addMeta($name, $content)
    {
        $this->meta[$name] = $content;
    }
    
    protected function setTitle($title)
    {
        $this->title = $title;
    }
    
    protected function abort()
    {
        http_response_code(404);
        $this->layout('exception\404');
        exit();
    }
    
    protected function unauthorized()
    {
        http_response_code(401);
        
        // redirect to loginpage
        $this->router->dispatch('login');
        exit();
    }
    
}