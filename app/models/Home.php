<?php

namespace Models;

class Home extends BaseModel
{
    
    public function all()
    {
        $elements = [];
        
        $articles = new Article();
        $tItems = $articles->all();
        if ($tItems != false) {
            $elements = array_merge($elements, $tItems);
        }
        
        $events = new Event();
        $tItems = $events->all();
        if ($tItems != false) {
            $elements = array_merge($elements, $tItems);
        }
        
        $comments = new Comment();
        $tItems = $comments->all();
        if ($tItems != false) {
            $elements = array_merge($elements, $tItems);
        }
        
        return $elements;
    }
    
}