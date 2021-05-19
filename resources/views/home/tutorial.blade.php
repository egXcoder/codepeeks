@extends('layouts.home')

@section('main')
<main class="tutorial-screen">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 tutorial-list-container">
                <div class="text-center">
                    <img src="{{asset($topic->image_url)}}" style="height: 60px">
                    <h2 class="header">{{$topic->name}}</h2>
                </div>
                <hr>
                <div class="tutorial-list">
                    @foreach($topic->tutorials as $single)
                    <a class="@if(url()->current() == route('home.tutorials',[$topic->name,$single->name])) active @endif"
                        href="{{route('home.tutorials',[$topic->name,$single->name])}}">{{$single->name}}</a>
                    @endforeach
                </div>
            </div>
            <div class="col-md-9 content">

                <h3 class="header">{{$tutorial->name}}</h3>
                <hr>
                <div class="tutorial-html">
                    {!! $tutorial->description !!}
                </div>
            </div>
        </div>
    </div>
</main>
@endsection