<?php

namespace App\View\Components;

use Illuminate\View\Component;

class BottomNav extends Component
{
    public $nav_topics;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($navTopics)
    {
        $this->nav_topics = $navTopics;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.bottom-nav');
    }
}
