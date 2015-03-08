<?php
use Libraries\Router;

$router = new Router();

$router->add('login', ['Controllers\AuthController', 'login']);
$router->add('logout', ['Controllers\AuthController', 'logout']);

// article
$router->add('articles/add', ['Controllers\ArticleController', 'getForm']);
$router->add('articles', ['Controllers\ArticleController', 'getIndex']);

// event
$router->add('events/add', ['Controllers\EventController', 'getForm']);
$router->add('events/*', ['Controllers\EventController', 'getShow']);
$router->add('events', ['Controllers\EventController', 'getIndex']);

// user
$router->add('me/report', ['Controllers\UserProgressController', 'getShow']);
$router->add('me', ['Controllers\UserController', 'getMe']);

$router->add('users/report/add', ['Controllers\UserPorgressController', 'getForm']);
$router->add('users/report', ['Controllers\UserProgressController', 'getIndex']);

$router->add('users/*/report/add', ['Controllers\UserProgressController', 'getForm']);
$router->add('users/*/report', ['Controllers\UserProgressController', 'getShow']);
$router->add('users/*', ['Controllers\UserController', 'getShow']);
$router->add('users', ['Controllers\UserController', 'getIndex']);

// usergroups
$router->add('groups/*', ['Controllers\UsergroupController', 'getShow']);
$router->add('groups', ['Controllers\UsergroupController', 'getIndex']);

// topics
$router->add('topics/add', ['Controllers\TopicController', 'getForm']);
$router->add('topics/*/update', ['Controllers\TopicController', 'postUpdate']);
$router->add('topics/*/delete', ['Controllers\TopicController', 'getDelete']);
$router->add('topics', ['Controllers\TopicController', 'getIndex']);

$router->add('*/*', ['Controllers\TopicController', 'route'], function($route){

    $route->add('comment', ['Controllers\CommentController', 'postComment']);
    
    switch($route->module) {
        case 'Models\Article':
            $route->add('update', ['Controllers\ArticleController', 'postUpdate']);
            $route->add('delete', ['Controllers\ArticleController', 'getDelete']);
            $route->add('', ['Controllers\ArticleController', 'getShow']);
            break;
        
        case 'Models\Event':
            $route->add('update', ['Controllers\EventController', 'postUpdate']);
            $route->add('delete', ['Controllers\EventController', 'getDelete']);
            $route->add('attend', ['Controllers\EventController', 'postAttendance']);
            $route->add('', ['Controllers\EventController', 'getShow']);
            break;
    }
});

$router->add('*', ['Controllers\TopicController', 'getShow']);

// home (empty string as path)
$router->add('', ['Controllers\HomeController', 'getIndex']);

$router->dispatch();