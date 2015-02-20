<?php

namespace Libraries\Seo;

class Seo /* Factory */
{
    public function getKeywords($content)
    {
        $keywords = new Keywords();
        return $keywords->calc($content);
    }
}