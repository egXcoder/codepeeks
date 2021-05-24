<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\TutorialHtmlFixer;
use App\Http\Controllers\Controller;
use App\Models\Topic;
use App\Models\Tutorial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TutorialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Topic $topic)
    {
        return view('admin.tutorials.index', [
            'topic'=>$topic,
            'tutorials'=>$topic->tutorials()->orderBy('order')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Topic $topic)
    {
        return view('admin.tutorials.create', ['topic'=>$topic]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Topic $topic)
    {
        request()->validate([
            'name'=> 'required|string',
            'short_description'=>'required|string',
            'description'=>'required|string'
        ]);

        $tutorial = Tutorial::where('topic_id', $topic->id)->orderBy('order', 'desc')->first();

        Tutorial::create([
            'name'=>request('name'),
            'short_description'=>request('short_description'),
            'description'=>(new TutorialHtmlFixer(request('description')))->fix(),
            'topic_id'=>$topic->id,
            'order'=>($tutorial->order??0) +1
        ]);

        return redirect(route('admin.tutorials.index', $topic->id))
                ->with(['success'=>'Tutorial is created successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Topic $topic, Tutorial $tutorial)
    {
        return view('admin.tutorials.edit', ['topic'=>$topic,'tutorial'=>$tutorial]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Topic $topic, Tutorial $tutorial)
    {
        request()->validate([
            'name'=>'required|string',
            'short_description'=>'required|string',
            'description'=>'required|string'
        ]);

        $tutorial->update([
            'name'=>request('name'),
            'short_description'=>request('short_description'),
            'description'=> (new TutorialHtmlFixer(request('description')))->fix(),
        ]);

        return back()->with(['success'=>'Tutorial is updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Topic $topic, Tutorial $tutorial)
    {
        $tutorial->delete();
        return redirect(route('admin.tutorials.index', [$topic->id]))
            ->with(['success'=>'Tutorial is deleted successfully']);
    }

    public function up(Tutorial $tutorial)
    {
        $predecessor = Tutorial::where('topic_id', $tutorial->topic->id)
            ->where('order', '<', $tutorial->order)
            ->orderBy('order', 'DESC')
            ->first();

        if (!$predecessor) {
            return back()->withErrors('Topic is already the first in order');
        }

        DB::transaction(function () use ($tutorial, $predecessor) {
            $this->exchangeOrder($tutorial, $predecessor);
        });

        return back()->with('success', 'Topic is ordered up successfully');
    }

    public function down(Tutorial $tutorial)
    {
        $successor = Tutorial::where('topic_id', $tutorial->topic->id)
            ->where('order', '>', $tutorial->order)
            ->first();

        if (!$successor) {
            return back()->withErrors('Topic is already the last in order');
        }

        DB::transaction(function () use ($tutorial, $successor) {
            $this->exchangeOrder($tutorial, $successor);
        });

        return back()->with('success', 'Topic is ordered up successfully');
    }

    public function trashedIndex()
    {
        return view('admin.tutorials.trashed.index', [
            'tutorials'=> Tutorial::onlyTrashed()->get()
        ]);
    }

    public function trashedRestore($tutorial_id)
    {
        $tutorial = Tutorial::withTrashed()->findOrFail($tutorial_id);
        
        if (!$tutorial->trashed()) {
            abort(422, 'Tutorial is not trashed to be restored');
        }

        $tutorial->restore();

        return redirect(route('admin.tutorials.trashed.index'))->with([
            'success'=> "Tutorial $tutorial->name is restored successfully"
        ]);
    }

    protected function exchangeOrder($tutorial, $anotherTutorial)
    {
        $tutorial_order = $tutorial->order;
        $tutorial->update(['order'=>$anotherTutorial->order]);
        $anotherTutorial->update(['order'=>$tutorial_order]);
    }
}
