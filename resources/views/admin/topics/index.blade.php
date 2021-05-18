@extends('admin.layouts.app')

@section('main')
<div class="topics-index-screen">
    <div class="col-md-4">
        <h3>All Topics</h3>
    </div>
    <table class="table">
        <thead>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th style="min-width:300px">Actions</th>
        </thead>
        <tbody>
            @foreach($topics as $topic)
            <tr>
                <td>{{$topic->id}}</td>
                <td>{{$topic->name}}</td>
                <td>{{$topic->description}}</td>
                <td>
                    <a class="btn btn-secondary" href="">View Tutorials</a>
                    <button class="btn btn-primary">UP</button>
                    <button class="btn btn-primary">Down</button>
                </td>
            </tr>
            @endforeach

        </tbody>

    </table>
</div>
@endsection