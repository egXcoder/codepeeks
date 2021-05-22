<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Topic;
use App\Models\Tutorial;
use App\Models\TutorialView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TutorialController extends Controller
{
    public function showDefaultTutorial(Topic $topic)
    {
        if($tutorial = $topic->tutorials->first()){
            return $this->showSpecificTutorial($topic,$tutorial);
        }

        return view('home.tutorial', [
            'topic'=>$topic,
            'tutorial'=>new Tutorial(['id'=>0])
        ]);
    }
    public function showSpecificTutorial(Topic $topic, Tutorial $tutorial)
    {
        $this->recordView($tutorial);
        return view('home.tutorial', [
            'topic'=>$topic,
            'tutorial'=>$tutorial
        ]);
    }

    protected function recordView($tutorial)
    {
        TutorialView::create([
            'tutorial_id'=>$tutorial->id,
            'created_at'=>date('Y-m-d H:i:s')
        ]);
    }

    public function search(Request $request)
    {
        request()->validate([
            'search'=>'required|string'
        ]);

        $words = explode(' ', $request->search);
            
        $query = DB::table('tutorials')
            ->join('topics', 'topics.id', '=', 'tutorials.topic_id');

        foreach ($words as $word) {
            $query->where(function ($builder) use ($word) {
                $builder
                ->where('tutorials.name', 'like', "%$word%")
                ->orWhere('topics.name', 'like', "%$word%")
                ->orWhereRaw("MATCH (tutorials.description) AGAINST ('$word')");
            });
        }

        $tutorials = $query
            ->select(['tutorials.name as tutorial_name','topics.name as topic_name'])
            ->get();

        return response()->json([
            'data'=>$tutorials
        ]);
    }
}
