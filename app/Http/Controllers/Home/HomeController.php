<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Topic;

class HomeController extends Controller
{
    public function __invoke()
    {
        return view('home.index', [
            'topics'=>$this->getTopics(),
        ]);
    }

    protected function getTopics()
    {
        return Topic::withCount(['tutorials'])->orderBy('order')->get();
    }
}
