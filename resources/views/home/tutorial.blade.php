@extends('home.layouts.app')

@section('main')
<main class="tutorial-screen">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 tutorial-list-container">
                <h2 class="header">{{$topic->name}}</h2>
                <hr>
                <div class="tutorial-list">
                    @foreach($topic->tutorials as $tutorial)
                    <a class="@if(str_contains(url()->current(),rawurlencode($tutorial->name))) active @endif"
                        href="{{route('home.tutorial',[$topic->name,$tutorial->name])}}">{{$tutorial->name}}</a>
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