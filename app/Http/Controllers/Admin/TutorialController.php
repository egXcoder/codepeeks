<?php

namespace App\Http\Controllers\Admin;

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
        return view('admin.tutorials.index', ['topic'=>$topic]);
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

    public function up(Tutorial $tutorial)
    {
        $predecessor = Tutorial::where('order', '<', $tutorial->order)->orderBy('order', 'DESC')->first();

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
        $successor = Tutorial::where('order', '>', $tutorial->order)->first();

        if (!$successor) {
            return back()->withErrors('Topic is already the last in order');
        }

        DB::transaction(function () use ($tutorial, $successor) {
            $this->exchangeOrder($tutorial, $successor);
        });

        return back()->with('success', 'Topic is ordered up successfully');
    }

    protected function exchangeOrder($tutorial, $anotherTutorial)
    {
        $tutorial_order = $tutorial->order;
        $tutorial->update(['order'=>$anotherTutorial->order]);
        $anotherTutorial->update(['order'=>$tutorial_order]);
    }
}
