<?php
namespace Models;
use PDO;
use Validators\ArticleValidator;

class Article extends BaseModel
{    
    public function all(array $topics = null)
    {
        $sql = 'SELECT  i.id,
                        i.slug,
                        i.title,
                        i.module,
                        a.content,
                        a.comment,
                        m.type AS media_type,
                        m.description AS media_description,
                        m.original AS media,
                        c.slug AS cat_slug,
                        c.title AS category,
                        "article" AS _type
                FROM articles AS a
                JOIN items AS i ON a.id = i.item_id AND i.module = :model
                JOIN media AS m ON m.id = i.media_id
                JOIN item_topics AS itc ON itc.item_id = i.id
                JOIN topics AS c ON c.id = itc.topic_id AND c.category = 1';
        
        if (!is_null($topics)) {
            $sql .= ' JOIN item_topics AS it ON it.item_id = i.id WHERE it.topic_id IN (:topic_id)';
            $this->bindArraySql($sql, ':topic_id', $topics);
        }
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':model', get_class(), PDO::PARAM_STR);
        
        if (!is_null($topics)) {
            $this->bindArray($stmt, ':topic_id', $topics, PDO::PARAM_INT);
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
                        m.type AS media_type,
                        m.description AS media_description,
                        m.original AS media,
                        c.id AS cat_id,
                        c.slug AS cat_slug,
                        c.title AS category,
                        "article" AS _type
                FROM articles AS a
                JOIN items AS i ON a.id = i.item_id AND i.module = :model
                LEFT JOIN media AS m ON m.id = i.media_id
                JOIN item_topics AS itc ON itc.item_id = i.id
                JOIN topics AS c ON c.id = itc.topic_id AND c.category = 1';
        
        if (is_string($id)) {
            // by slug
            $sql .= ' WHERE i.slug = :slug';
        } else {
            $sql .= ' WHERE i.id = :id';
        }
        
        $stmt = $this->db->prepare($sql);
        
        if (is_string($id)) {
            $stmt->bindValue(':slug', $id, PDO::PARAM_STR);
        } else {
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        }
        
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