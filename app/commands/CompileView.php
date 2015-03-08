<?php
namespace Commands;

class CompileView
{
    public function run()
    {
        $views = $this->getViews();
        
        foreach ($views as $file) {
            
            $content    = $this->getView($file);
            $content    = $this->replaceInclude($content);
            $content    = $this->minifyHtml($content);
            
            $this->storeView($file, $content);
        }
    }
    
    protected function getViews()
    {
        // ignore mail directory
    }
    
    protected function getView($file)
    {
        return file_get_content($file);
    }
    
    protected function storeView($key, $view)
    {
        
    }
    
    protected function replaceInclude($content)
    {
        // preg_match <?php include( PATH );
        
        // include file content
        
        // return compiled view
    }
    
    protected function minifyHtml($content)
    {
        // remove all extra spaces, tabs, new lines
        
        // return minified version
        
    }
    
    protected function optimize($content)
    {
        // replace defined vars
        
        // replace urls with string only
    }
}