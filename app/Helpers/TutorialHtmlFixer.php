<?php

namespace App\Helpers;

class TutorialHtmlFixer
{
    protected $description;
    
    public function __construct($description)
    {
        $this->description = $description;
    }

    public function fix()
    {
        $this->fixToSafeQuotes();
        return $this->description;
    }

    /**
     * alter &quot; to be single quote ' 
     * as single quote is safer in render than double quote
     * because double quote may interfer with html attributes such
     * <span style="font-family:&quot;Courier&quot;"></span>
     * <span style="font-family:'Courier'"></span>
     */
    protected function fixToSafeQuotes()
    {
        $this->description = preg_replace_callback('/&quot;/', function ($matches) {
            return '\'';
        }, $this->description);
    }
}
