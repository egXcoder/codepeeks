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
                    @forelse($topic->tutorials as $single)
                    <a class="@if(url()->current() == route('home.tutorials.specific',[$topic->name,$single->name])) active @endif"
                        href="{{route('home.tutorials.specific',[$topic->name,$single->name])}}">{{$single->name}}</a>
                    @empty
                    <p class="text-center">No Tutorials Yet</p>
                    @endforelse
                </div>
            </div>
            <div class="col-md-9 content">
                @if($tutorial->id)
                <h3 class="header">{{$tutorial->name}}</h3>
                <hr>
                <div class="tutorial-html">
                    {!! $tutorial->description !!}
                </div>
                @else
                <p>Tutorials will be added soon</p>
                @endif
            </div>
        </div>
    </div>
</main>
@endsection