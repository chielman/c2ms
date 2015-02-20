<?php

namespace Libraries\Seo;

class Keywords
{
    protected $ignore = [
        'nl' => [
            // lidwoorden
            'de', 'het', 'een',
            // 
            'om', 'bij', 'op', 'voor', 'achter', 'naast', 'tussen', 'in', 'aan', 'tot', 'door', 'met', 'zonder', 'van',
            // 
            'ik', 'jij', 'hij', 'wij', 'jullie', 'zij', 'hun',
            // bezittelijk voornaamwoorden
            'mijn', 'jouw', 'hen', 'ons',
            // aanwijzend
            'die', 'dat', 'daar', 'deze',
            // 
            'te', 'er', 'elk',
            // boolean
            'en', 'of',
            //
            'daarvoor', 'daarna', 'daartussen', 'vervolgens', 'tevens', 'ondertussen', 'al', 'dus', 'ook',
            // werkwoorden
            'hebben', 'heeft', 'had', 'hadden', 'gehad', 'heb',
            'zal', 'zullen', 'zou', 'zouden',
            'ben', 'bent', 'is', 'zijn', 'was', 'waren', 'geweest',
            'ga', 'gaan', 'ging', 'gingen', 'gegaan',
            'word', 'wordt', 'worden', 'werd', 'werden', 'geworden',
            'kan', 'kunt', 'kunnen', 'kon', 'konden', 'gekunt',
            
        ]
    ];
    
    public function calc($title, $content, $lang = 'nl')
    {
        $words      = $this->split($content);
        $keywords   = array_diff($words, $this->ignore[$lang]);
        $map        = $this->map($keywords);
        $count      = count($words);
        
        // calculate density
        array_walk($map, function(&$item, $key, $count){
            $item = $item / $count;
        }, $count);
        
        return $map;
    }
    
    protected function split($content)
    {
        $words = preg_split('/[ ,.?!-]/', $content);
        
        return $words;
    }
    
    protected function map(array $keywords)
    {
        return array_count_values($keywords);
    }
}