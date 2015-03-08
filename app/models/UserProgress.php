<?php

namespace Models;

use PDO;

/**
 * Description of UserProgress
 *
 * @author Erwin
 */
class UserProgress extends BaseModel
{
    protected $reports = [
        'Models\Reports\Progress201502'
    ];
    
    public function getReports()
    {
        $reports = [];
        
        foreach ($this->reports as $report) {
            /*  @var $class \Models\Reports\Report */
            $class = new $report();
            $reports[] = $class;
        }
        
        return $reports;
    }
    
    public function all()
    {
        $sql = 'SELECT * 
                FROM user_progress AS up
                JOIN users AS u ON u.id = up.user_id';
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        
        $data = $stmt->fetchAll();
        
        foreach($data as &$item) {
            
            $item['report'] = json_decode($item['report'], true);
            $item['created'] = from_sql_date($item['created']);
            
            $class = $item['class'];
            $item = (new $class())->build($item);
        }
        
        return $data;
    }
    
    public function update()
    {
        
    }
    
    public function getByUser($id)
    {
        $sql = 'SELECT * 
                FROM user_progress AS up
                WHERE user_id = :id';
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        
        $data = $stmt->fetchAll();

        foreach ($data as &$item) {
            $item['report'] = json_decode($item['report'], true);
            $item['created'] = from_sql_date($item['created']);
            
            $class = $item['class'];
            $item = (new $class())->build($item);
        }

        return $data;
    }
}
