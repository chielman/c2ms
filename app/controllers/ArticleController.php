<?php

namespace Controllers;
use Libraries\Router;
use Models\Article;
use Models\Media;
use Models\Comment;

class ArticleController extends BaseController
{
    protected $model;
    
    public function __construct(Router $route)
    {
        parent::__construct($route);
        $this->model = new Article();
    }
    
    /**
     * Display all articles
     */
    public function getIndex()
    {
        $topics = $this->user->rights('article.view');
        if (in_array(null, $topics)) { 
            $topics = null;
        }
        
        $articles   = $this->model->all($topics);

        if ($articles != false) {
            
            $this->layout('topic/single-topic', ['title' => 'Articles', 'items' => $articles]);
            
        } else {
            
            $this->abort();
        }
    }
    
    public function getForm()
    {
        // TODO verify the user can do this
        if (!$this->user->can('article.create')) {
            $this->unauthorized();
        }
        
        // TODO add script to head to load the editor
        
        
        $this->layout('article/single-article', [   
            'title' => 'naamloos', 
            'content' => 'Lorum ipsum dolorum set amet.', 
            'comment' => 0, 
            'media' => '', 
            'media_description' => ''
       ]);
    }
    
    /**
     * Display an article
     * 
     * @param type $id
     */
    public function getShow($slug)
    {              
        $article = $this->model->get($slug);
        
        if (!$this->user->can('article.view', $article['cat_id'])) {
            $this->unauthorized();
        }
        
        if ($article != false ) {
            
            if ($this->user->can('article.comment') && $article['comment']) {
                $commentModel = new Comment;
                $article['comments'] = $commentModel->getFor($article['id']);
            }
            
            $this->setTitle($article['title']);
            //$this->addMeta('description', '');
            //$this->addMeta('keywords', '');
            
            // article found, render
            $this->layout('article/single-article', $article);
        } else {
            // article not found return 404
            $this->abort();
        }
    }
    
    public function postUpdate($slug)
    {
        $article = $this->model->get($slug);
        
        if ($article != false) {
            
            if ($this->user->can('article.edit')) {
            
                if (count($_FILES) > 0) {

                    // upload media
                    $media = new Media();
                    $_POST['media_id'] = $media->upload('stories', $slug, $_FILES);

                }   

                $this->model->update($article, $_POST);
                
            } else {
                
                $this->unauthorized();
            }
            
        } else {
            
            $this->abort();
        }
    }
}