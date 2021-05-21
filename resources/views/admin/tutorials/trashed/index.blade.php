@extends('layouts.admin')

@section('main')
<div class="tutorials-index-screen">
    <x-alert-messages />
    <div class="d-flex justify-content-between">
        <h3>All Trashed Tutorials</h3>
    </div>
    <table class="table">
        <thead>
            <th>ID</th>
            <th>Name</th>
            <th>Topic Name</th>
            <th style="min-width:350px">Actions</th>
        </thead>
        <tbody>
            @forelse($tutorials as $tutorial)
            <tr>
                <td>{{$tutorial->id}}</td>
                <td>{{$tutorial->name}}</td>
                <td>{{$tutorial->topic->name}}</td>
                <td class="d-flex">
                    <form action="{{route('admin.tutorials.trashed.restore',$tutorial->id)}}" method="POST">
                        @csrf
                        @method('put')
                        <button class="mx-1 btn btn-primary">Restore</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td>
                    No Trashed Tutorials
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection