<?php
namespace Models;
use PDO;
use Validators\ArticleValidator;

class Article extends BaseModel
{    
    public function all($topic = false)
    {
        $sql = 'SELECT  i.id,
                        i.slug,
                        i.title,
                        i.module,
                        a.content,
                        a.comment,
                        "article" AS _type
                FROM articles AS a
                JOIN items AS i ON a.id = i.item_id AND i.module = :model';
        
        if ($topic !== false) {
            $sql .= ' JOIN item_topics AS it ON it.item_id = i.id WHERE it.topic_id = :topic_id';
        }
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':model', get_class(), PDO::PARAM_STR);
        
        if ($topic !== false) {
            $stmt->bindValue(':topic_id', $topic, PDO::PARAM_INT);
        }
        
        $stmt->execute();
        
        return $stmt->fetchAll();        
    }
    
    public function get($id)
    {
        $sql = 'SELECT  i.id,
                        i.slug,
                        i.title,
                        a.content,
                        a.comment,
                        "article" AS _type
                FROM articles
                JOIN items ON articles.id = items.item_id AND items.module = :model
                WHERE articles.id = :id';

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':model', get_class(), PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch();
    }
    
    public function getBySlug($slug)
    {
        $sql = 'SELECT  i.id,
                        i.slug,
                        i.title,
                        a.content,
                        a.comment,
                        "article" AS _type
                FROM articles AS a
                JOIN items AS i ON a.id = i.item_id AND i.module = :model
                WHERE i.slug = :slug';
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':slug', $slug, PDO::PARAM_STR);
        $stmt->bindValue(':model', get_class(), PDO::PARAM_STR);
        $stmt->execute();
        
        return $stmt->fetch();        
    }
    
    public function update($original, $params)
    {
        $sql = 'UPDATE articles AS a
                JOIN items AS i ON a.id = i.item_id AND i.module = :module
                SET     i.slug = :slug,
                        i.title = :title,
                        a.content = :content,
                        a.comment = :comment
                WHERE i.id = :id';
        
        $validator = new ArticleValidator();
        $params = $validator->validate($params);
        $original = array_merge($original, $params);
        
        $stmt = $this->db->prepare($sql);
        // predefined
        $stmt->bindValue(':module', get_class(), PDO::PARAM_STR);
        $stmt->bindValue(':id', $original['id'], PDO::PARAM_INT);
        // user input
        $stmt->bindValue(':slug', $original['slug'], PDO::PARAM_STR);
        $stmt->bindValue(':title', $original['title'], PDO::PARAM_STR);
        $stmt->bindValue(':content', $original['content'], PDO::PARAM_STR);
        $stmt->bindValue(':comment', $original['comment'], PDO::PARAM_INT);
        $stmt->execute();
    }
}