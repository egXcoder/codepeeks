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
        $this->fixStylesOfCodeTakenFromVscode();
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

    protected function fixStylesOfCodeTakenFromVscode()
    {
        $this->description = preg_replace_callback('/<div style="color: rgb\(191, 199, 213\);/', function ($matches) {
            return '<div style="padding:1rem;overflow:auto;color: rgb(191, 199, 213);';
        }, $this->description);
    }
}
