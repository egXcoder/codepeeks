@extends('admin.layouts.app')

@section('main')
<div class="topics-index-screen">

    <x-alert-messages />

    <div class="d-flex justify-content-between">
        <h3>All Topics</h3>
    </div>
    <table class="table">
        <thead>
            <th>ID</th>
            <th>Image</th>
            <th>Name</th>
            <th>Description</th>
            <th style="min-width:350px">Actions</th>
        </thead>
        <tbody>
            @foreach($topics as $topic)
            <tr>
                <td>{{$topic->id}}</td>
                <td><img src="{{asset($topic->image_url)}}" style="height: 60px"></td>
                <td>{{$topic->name}}</td>
                <td>{{$topic->description}}</td>
                <td class="d-flex">
                    <a class="mx-1 btn btn-success" href="{{route('admin.tutorials.index',$topic->id)}}">View
                        Tutorials</a>
                    <a class="mx-1 btn btn-success" href="{{route('admin.topics.edit',$topic->id)}}">Edit</a>
                    <form action="{{route('admin.topics.up',$topic->id)}}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{$topic->id}}">
                        <button class="mx-1 btn btn-primary">UP</button>
                    </form>

                    <form action="{{route('admin.topics.down',$topic->id)}}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{$topic->id}}">
                        <button class="mx-1 btn btn-primary">Down</button>
                    </form>
                </td>
            </tr>
            @endforeach

        </tbody>

    </table>
    <a class="btn btn-success" href="{{route('admin.topics.create')}}"><i class="fas fa-plus"></i> Create Topic</a>
</div>
@endsection