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
        return view('admin.topics.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'name'=>'required|string|unique:topics',
            'description'=>'required|string|max:255',
            'image'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $imageName = time().'.'.$request->image->extension();
        request('image')->move(public_path('images'), $imageName);

        Topic::create([
            'name'=>request('name'),
            'description'=>request('description'),
            'image_url'=>"images/$imageName",
            'order'=> Topic::orderBy('order', 'desc')->first()->order ?? 0 + 1,
        ]);

        return redirect(route('admin.topics.index'))->with(['success'=>'Topic is created successfully']);
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
    public function edit(Topic $topic)
    {
        return view('admin.topics.edit', ['single'=>$topic]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Topic $topic)
    {
        request()->validate([
            'name'=>'required|string',
            'description'=>'required|string',
        ]);

        
        $inputs = [
            'name'=>request('name'),
            'description'=>request('description'),
        ];
        
        if (request('image')) {
            request()->validate(['image'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048']);
            
            $imageName = time().'.'.request('image')->extension();
            request('image')->move(public_path('images'), $imageName);

            $inputs = array_merge($inputs, [
                'image_url'=> "images/$imageName",
            ]);
        }

        $topic->update($inputs);

        return redirect(route('admin.topics.index'))->with(['success'=>'Topic is updated successfully']);
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
            $this->exchangeOrder($topic, $successor);
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
