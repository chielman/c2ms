<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Models\Reports;
use DateTime;

/**
 * Description of Report
 *
 * @author Erwin
 */
abstract class Report
{
    public function getName()
    {
        return $this->name;
    }
    
    public function getFields()
    {
        return $this->fields;
    }
    
    public function buildTemplate()
    {
        $template = [];
        $template['created'] = new DateTime();
        $template['report'] = [];
        
        foreach($this->fields as $key => $value) {
            $template['report'][$key] = array_merge($value, ['value' => '']);
        }
        
        return $template;
    }
    
    public function build(array $data)
    {
        $report     = $data['report'];
        $results    = [];
        
        foreach($this->fields as $key => $value) {
            
            if (isset($report[$key])) {
                $results[$key] = array_merge($value, ['value' => $report[$key]]);
            }
        }
        
        $data['report'] = $results;
        
        return $data;
    }
}
