<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Models\Reports;

/**
 * Description of Progress201502
 *
 * @author Erwin
 */
class Progress201502 extends Report
{
    protected $name = 'Voortgang 02-2015';
    
    protected $fields = [
        'speed' => ['caption' => 'snelheid', 'type' => 'rating'],
        'size'  => ['caption' => 'lengte'],
        'height' => ['caption' => 'hoogte']
    ];
}
