<?php

namespace Models;
use PDO;
use Validators\EventValidator;

class Event extends BaseModel
{
    
    public function all($topic = false)
    {
        $sql = 'SELECT  i.id,
                        i.slug,
                        i.title,
                        i.module,
                        e.description,
                        e.start,
                        e.end,
                        e.fullday,
                        e.attendance,
                        e.attend_end,
                        e.comment,
                        "event" AS _type
                FROM events AS e
                JOIN items AS i ON e.id = i.item_id AND i.module = :model';
        
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
                        e.description,
                        e.start,
                        e.end,
                        e.fullday,
                        e.attendance,
                        e.attend_end,
                        e.comment,
                        "event" AS _type
                FROM events AS e
                JOIN items AS i ON e.id = iitem_id AND i.module = :model
                WHERE id = :id';
        
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
                        e.description,
                        e.start,
                        e.end,
                        e.fullday,
                        e.attendance,
                        e.attend_end,
                        e.comment,
                        "event" AS _type
                FROM events AS e
                JOIN items AS i ON e.id = i.item_id AND i.module = :model
                WHERE i.slug = :slug';
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':slug', $slug, PDO::PARAM_STR);
        $stmt->bindValue(':model', get_class(), PDO::PARAM_STR);
        $stmt->execute();
        
        return $stmt->fetch();
    }
    
    public function update($original, $params)
    {
        $sql = 'UPDATE events AS e
                JOIN items AS i ON a.id = i.item_id AND i.module = :module
                SET     i.slug = :slug,
                        i.title = :title,
                        e.description = :description,
                        e.start = :start,
                        e.end = :end,
                        e.fullday = :fullday,
                        e.attendance = :attendance,
                        e.attend_end = :attend_end,
                        e.comment = :comment
                WHERE i.id = :id';
        
        $validator = new EventValidator();
        $params = $validator->validate($params);
        $original = array_merge($original, $params);
        
        $stmt = $this->db->prepare($sql);
        // predefined
        $stmt->bindValue(':module', get_class(), PDO::PARAM_STR);
        $stmt->bindValue(':id', $original['id'], PDO::PARAM_INT);
        // user input
        $stmt->bindValue(':slug', $original['slug'], PDO::PARAM_STR);
        $stmt->bindValue(':title', $original['title'], PDO::PARAM_STR);
        $stmt->bindValue(':description', $original['description'], PDO::PARAM_STR);
        $stmt->bindValue(':start', $original['start'], PDO::PARAM_STR);
        $stmt->bindValue(':end', $original['end'], PDO::PARAM_STR);
        $stmt->bindValue(':fullday', $original['fullday'], PDO::PARAM_INT);
        $stmt->bindValue(':attendance', $original['attendance'], PDO::PARAM_INT);
        $stmt->bindValue(':attend_end', $original['attend_end'], PDO::PARAM_STR);
        $stmt->bindValue(':comment', $original['comment'], PDO::PARAM_INT);
        $stmt->execute();
    }
    
    public function attendance($id)
    {
        $sql = 'SELECT  u.id,
                        u.name,
                        a.status 
                FROM attendances AS a
                JOIN users AS u ON u.id = a.user_id
                WHERE a.event_id = :id';
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
    
    public function attend($event_id, $user_id, $status)
    {
        $sql = 'INSERT INTO attendances (event_id, user_id, status) VALUES (:event_id, :user_id, :status) ON DUPLICATE KEY UPDATE status = :status';
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':event_id', $event_id, PDO::PARAM_INT);
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindValue(':status', $status, PDO::PARAM_INT);
        $stmt->execute();
        
        return $this->db->lastInsertId();
    }

}

