@extends('admin.layouts.app')


@section('main')
<div class="tutorials-index-screen">
    <x-alert-messages />
    <div class="d-flex justify-content-between">
        <h3>All Tutorials of {{$topic->name}}</h3>
    </div>
    <table class="table">
        <thead>
            <th>ID</th>
            <th>Name</th>
            <th style="min-width:350px">Actions</th>
        </thead>
        <tbody>
            @foreach($tutorials as $tutorial)
            <tr>
                <td>{{$tutorial->id}}</td>
                <td>{{$tutorial->name}}</td>
                <td class="d-flex">
                    <a class="mx-1 btn btn-success"
                        href="{{route('admin.tutorials.edit',[$topic->id,$tutorial->id])}}">Edit</a>

                    <form action="{{route('admin.tutorials.up',$tutorial->id)}}" method="Post">
                        @csrf
                        <button class="mx-1 btn btn-primary">Up</button>
                    </form>
                    <form action="{{route('admin.tutorials.down',$tutorial->id)}}" method="Post">
                        @csrf
                        <button class="mx-1 btn btn-primary">Down</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a class="btn btn-success" href="{{route('admin.tutorials.create',$topic->id)}}"><i class="fas fa-plus"></i> Create
        Tutorial</a>
</div>
@endsection