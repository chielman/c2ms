<?php
namespace Libraries\Seo;

class Analyse
{
    const IGNORE = '()"\';:';
    
    protected $analysis     = [];
    
    public function run($text)
    {
        // remove some characters
        $this->text = str_replace( str_split( self::IGNORE ) , ' ', $text);

        $this->getParagraphs();
        $this->getSentences();
        $this->getKeywords();
        
        $this->density();
        
        $this->paragraphImportance();
        $this->sentenceImportance();
        
        echo json_encode($this->analysis);
    }
    
    const PARAGRAPHS_REGEX = '/<p>(.*?)<\/p>/mi';
    
    protected function getParagraphs()
    {
        preg_match_all(self::PARAGRAPHS_REGEX, $this->text, $matches, PREG_OFFSET_CAPTURE);
        
        foreach($matches[1] as $match) {
            $this->analysis['paragraphs'][] = ['text' => $match[0], 'offset' => $match[1]];
        }
    }
    
    const SENTENCE_REGEX = '/(.*?)[\.|!|\?]/mi';
    const SENTENCE_IGNORE = '';
    
    protected function getSentences()
    {
        foreach ($this->analysis['paragraphs'] as &$paragraph)
        {
            preg_match_all(self::SENTENCE_REGEX, $paragraph['text'], $matches, PREG_OFFSET_CAPTURE);
            
            foreach($matches[1] as $match) {
                $paragraph['sentences'][] = ['text' => strtolower($match[0]), 'offset' => $paragraph['offset'] + $match[1]];
            }
            
        }
    }
    
    const KEYWORD_REGEX = '/\s/mi';
    
    protected function getKeywords()
    {
        
        foreach ($this->analysis['paragraphs'] as &$paragraph)
        {
            foreach ($paragraph['sentences'] as &$sentence) {
                
                $matches = preg_split(self::KEYWORD_REGEX, $sentence['text'], -1, PREG_SPLIT_NO_EMPTY);
                
                $sentence['words'] = $matches;
                
            }
        }
    }
    
    protected function density()
    {
        $wordList = [];
        
        foreach ($this->analysis['paragraphs'] as &$paragraph) {
            
            $paragraphWordList = [];
            
            foreach ($paragraph['sentences'] as &$sentence) {
                
                $paragraphWordList = array_merge($paragraphWordList, $sentence['words']);
                
                $sentence['count']      = count($sentence['words']);
                $sentence['density']    = array_count_values($sentence['words']);
                arsort($sentence['density']);
            }
            
            $wordList = array_merge($wordList, $paragraphWordList);
            $paragraph['count']     = count($paragraphWordList);
            $paragraph['density']   = array_count_values($paragraphWordList);
            arsort($paragraph['density']);
            
        }
        
        $this->analysis['count']    = count($wordList);
        $this->analysis['density']  = array_count_values($wordList);
        arsort($this->analysis['density']);
    }
    
    protected function calculateWordValue()
    {
        if (!isset($this->analysis['_wvalue'])) {
            $wordValue  = [];
            $count      = $this->analysis['count'];

            foreach ($this->analysis['density'] as $word => $wordCount) {
                $wordValue[$word] = $wordCount / $count;
            }        

            $this->analysis['_wvalue'] = $wordValue;
        }
        return $this->analysis['_wvalue'];
    }
    
    protected function paragraphImportance()
    {
        $wordValue = $this->calculateWordValue();
        
        // compare overall density map to the paragraph density map
        foreach ($this->analysis['paragraphs'] as &$paragraph) {
            
            $paragraphValue = 0;
            
            foreach ($paragraph['density'] as $word => $count) {
                
                $paragraphValue += $wordValue[$word] * $count;
            }
            
            $paragraph['value'] = $paragraphValue / $paragraph['count'];
        }
    }
    
    protected function sentenceImportance()
    {
        // compare overall density map to the sentence density map
        $wordValue = $this->calculateWordValue();
        
        foreach ($this->analysis['paragraphs'] as &$paragraph) {
            
            foreach ($paragraph['sentences'] as &$sentence) {
                
                $sentenceValue = 0;
                
                foreach ($sentence['density'] as $word => $count) {
                    
                    $sentenceValue += $wordValue[$word] * $count;
                    
                }
                
                $sentence['value'] = $sentenceValue / $sentence['count'];
                
                $sentence['valueWeight'] = $paragraph['value'] * $sentence['value'];
            }
        }
    }
}