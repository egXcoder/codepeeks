<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.topics.index', [
            'topics'=>Topic::orderBy('order')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function up(Topic $topic)
    {
        $predecessor = Topic::where('order', '<', $topic->order)->orderBy('order', 'DESC')->first();

        if (!$predecessor) {
            return back()->withErrors('Topic is already the first in order');
        }

        DB::transaction(function () use ($topic, $predecessor) {
            $this->exchangeOrder($topic, $predecessor);
        });

        return back()->with('success', 'Topic is ordered up successfully');
    }

    public function down(Topic $topic)
    {
        $successor = Topic::where('order', '>', $topic->order)->first();

        if (!$successor) {
            return back()->withErrors('Topic is already the last in order');
        }

        DB::transaction(function () use ($topic, $successor) {
            $this->exchangeOrder($topic,$successor);
        });

        return back()->with('success', 'Topic is ordered up successfully');
    }

    protected function exchangeOrder($topic, $anotherTopic)
    {
        $topic_order = $topic->order;
        $topic->update(['order'=>$anotherTopic->order]);
        $anotherTopic->update(['order'=>$topic_order]);
    }
}
