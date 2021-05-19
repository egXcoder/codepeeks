<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Topic;
use App\Models\TutorialView;

class TutorialController extends Controller
{
    public function show(Topic $topic, $tutorialName=null)
    {
        if (!$tutorialName) {
            $tutorialName = $topic->tutorials->first()->name;
        }

        if ($tutorial = $this->getTutorialFromTopic($topic, $tutorialName)) {
            $this->recordView($tutorial);
            return view('home.tutorial', [
                'topic'=>$topic,
                'tutorial'=>$tutorial
            ]);
        }
        
        abort(404, 'Not Found');
    }

    protected function getTutorialFromTopic(Topic $topic, $tutorialName)
    {
        return $topic->tutorials->where('name', $tutorialName)->first();
    }

    protected function recordView($tutorial)
    {
        TutorialView::create([
            'tutorial_id'=>$tutorial->id,
            'created_at'=>date('Y-m-d H:i:s')
        ]);
    }
}
