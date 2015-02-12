<?php

namespace Models;
use Libraries\Database;
use PDOStatement;

class BaseModel
{
    protected $db;
    
    public function __construct()
    {
        $this->db = Database::getInstance();
    }
    
    protected function bindArraySql(&$sql, $parameter, $array)
    {
        $count = count($array);
        $parameters = [];
        
        for($i = 0; $i < $count; $i++) {
            $parameters[] = $parameter . $i;
        }
        
        $sqlParameter = implode(',' , $parameters);
        
        $sql = str_replace($parameter, $sqlParameter, $sql);
    }
    
    protected function bindArray(PDOStatement $stmt, $parameter, $array, $type)
    {
        $count = count($array);
        for ($i = 0; $i < $count; $i++) {
            $stmt->bindValue($parameter. $i, $array[$i], $type);
        }
    }
}