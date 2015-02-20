<?php
namespace Models;
use PDO;

class Topic extends BaseModel
{
    
    public function all()
    {
        $sql = 'SELECT * FROM topics';
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        
        return $stmt->fetchAll();        
    }
    
    public function get($id)
    {
        $sql = 'SELECT * FROM topics WHERE id = :id LIMIT 0,1';
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetch();
    }
    
    public function getItemThroughTopic($topic_slug, $item_slug)
    {
        $topic = $this->getBySlug($topic_slug);

        if ($topic) {
            $item = $this->getItemFrom($topic['id'], $item_slug);
            
            $item['topic'] = $topic;
            
            return $item;
        }
        
        return false;
    }
    
    public function getItem($module, $id)
    {
        $model = new $module();
        return $model->get($id);
    }
    
    public function getBySlug($slug)
    {
        $sql = 'SELECT * FROM topics WHERE slug = :slug';
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':slug', $slug, PDO::PARAM_STR);
        $stmt->execute();
        
        return $stmt->fetch();        
    }
    
    public function getItemFrom($topic_id, $item_slug)
    {
        $sql = 'SELECT  items.module, 
                        items.item_id 
                FROM items
                JOIN item_topics ON item_topics.topic_id = :topic_id AND item_topics.item_id = items.id
                WHERE items.slug = :slug';
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':topic_id', $topic_id, PDO::PARAM_INT);
        $stmt->bindValue(':slug', $item_slug, PDO::PARAM_STR);
        $stmt->execute();
        
        return $stmt->fetch(); 
    }
    
    protected function access($rule, array $rules = [], array $topics = null)
    {
        // check if rule exists
        if (isset($rules[$rule])) {
            
            // everything is allowed
            if (in_array(null, $rules[$rule])) { return null; }
            
            // if rule exists see if we can access this topic
            if (!is_null($topics)) {
                
                $allowed = array_intersect($topics, $rules[$rule]);
                
                return $allowed;
                
            } else {
                
                $allowed = $rules[$rule];
                
                if(($key = array_search(null, $allowed)) !== false) {
                    unset($allowed[$key]);
                }
                
                return $allowed;
                
            }
            
        }
        
        return [];
    }
    
    public function getItems(array $rules = [], array $topic = null)
    {
        $elements = [];
        
        $articles = new Article();
        $tItems = $articles->all(  $this->access('article.view', $rules, $topic) );

        if ($tItems != false) {
            $elements = array_merge($elements, $tItems);
        }

        $events = new Event();
        $tItems = $events->all( $this->access('event.view', $rules, $topic) );
        if ($tItems != false) {
            $elements = array_merge($elements, $tItems);
        }

        $comments = new Comment();
        $tItems = $comments->all( $this->access('comment.view', $rules, $topic) );
        if ($tItems != false) {
            $elements = array_merge($elements, $tItems);
        }

        return $elements;
    }
}