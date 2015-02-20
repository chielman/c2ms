<?php

namespace Controllers;
use Models\User;
use Libraries\Authentication;
use Libraries\Router;
use Libraries\Mail;

class UserController extends BaseController
{
    protected $model;
    
    public function __construct(Router $route)
    {
        parent::__construct($route);
        $this->model = new User();
    }
    
    public function getIndex()
    { 
        $users = $this->model->all();
        
        $this->layout('user/list', ['users' => $users]);
    }
    
    public function getMe()
    {        
        if ( $this->user->isGuest() ) {
            // not logged in redirect to login page
            $this->route('login');
            
        } else {
            
            $this->getShow( $this->user->getId() );

        }
    }
    
    public function getShow($id)
    {        
        if (is_string($id)) {
            $user = $this->model->getByName($id);
        } else {
            $user = $this->model->get($id);
        }
               
        if ($user != false) {
            
            $profile = $this->model->profile($user['id']);
            
            if ($profile != false) {
                $user['profile'] = $profile;
            }
            
            // article found, render
            $this->layout('user/profile', $user);
        } else {
            // article not found return 404
            $this->abort();
            
        }
    }
    
    public function getForgotPassword()
    {
        $this->layout('user/forgot');
    }
    
    public function postForgetPassword()
    {
       $username = filter_input(INPUT_POST, 'username');
       
       $user = $this->model->getByName($username);
       
       if ($user != false) {
           
           // set token and date
           
           $message = $this->view('mail/forgot', ['token' => $token], true);
           
           // send the token and date
           $mail = new Mail();
           $mail->to($user['username']);
           $mail->message($message);
           $sendSuccess = $mail->send();
           
           // show successful send message
           if ($sendSuccess) {
               
           } else {
               
           }
           
       } else {
           
           // username not found
           
       }
    }
    
    public function postRegister()
    {
        $username = filter_input(INPUT_POST, 'username');
        $password = filter_input(INPUT_POST, 'password');
        
        $hash = Authentication::generate($password);
        
        $user = compact('username', 'hash');
        
        $this->model->register($user);
    }
}