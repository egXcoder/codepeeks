<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Topic;
use App\Models\Tutorial;
use App\Models\TutorialView;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $topics = Topic::all();
        return view('admin.index', [
            'topics'=>$topics,
            'topics_count'=>$topics->count(),
            'tutorial_count'=>Tutorial::count(),
            'tutorial_views_count'=>TutorialView::count(),
        ]);
    }
}
