<?php

namespace Models;
use PDO;

class Usergroup extends BaseModel
{
    
    public function all()
    {
        $sql = 'SELECT u.id, u.slug, u.name
                FROM usergroups AS u';
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
    
    public function get($id)
    {
        $sql = 'SELECT id, slug, name FROM usergroups';
        
        if (is_string($id)) {
            $sql .= ' WHERE slug = :slug';
        } else {
            $sql .= ' WHERE id = :id';
        }
        
        $stmt = $this->db->prepare($sql);
        
        if (is_string($id)) {
            $stmt->bindValue(':slug', $id, PDO::PARAM_STR);
        } else {
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        }
        
        $stmt->execute();
        
        return $stmt->fetch();
    }
    
    public function getPermissions()
    {
        $sql = 'SELECT id, permission FROM permissions';
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
    
    public function getGroupPermissions($group)
    {
        if (is_string($group)) { $group = [$group]; }
        
        $sql = 'SELECT up.usergroup_id, p.id AS permission_id, p.permission, t.slug AS topic_slug, t.title AS topic
                FROM usergroup_permissions AS up
                LEFT JOIN permissions AS p ON p.id = up.permission_id
                LEFT JOIN topics AS t ON t.id = up.topic_id
                WHERE usergroup_id IN (:id)
                ';
        $this->bindArraySql($sql, ':id', $group);
        
        $stmt = $this->db->prepare($sql);
        $this->bindArray($stmt, ':id', $group, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
    
    public function getUsers($group)
    {
        if (is_string($group)) { $group = [$group]; }
        
        $sql = 'SELECT *
                FROM user_usergroups AS uu
                JOIN users AS u ON uu.user_id = u.id
                WHERE usergroup_id IN (:id)';
        $this->bindArraySql($sql, ':id', $group);
        
        $stmt = $this->db->prepare($sql);
        $this->bindArray($stmt, ':id', $group, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
    
}