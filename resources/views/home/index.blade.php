@extends('layouts.home')

@section('main')
<main class="index">
    <section class="welcome">
        <img src="{{asset('images/design.png')}}">
    </section>
    <section class="all-topics">
        <div class="container">
            <div class="d-flex align-items-center justify-content-lg-between">
                <h1 class="header">Topics</h1>
                <img src="{{asset('images/peek.jpg')}}" style="width:300px">
            </div>
            <hr class="mt-0">
            <div class="row">
                @foreach($topics as $topic)
                <div class="col-lg-4 col-md-3 col-sm-6 topic">
                    <img src="/{{$topic->image_url}}" class="img-fluid">
                    <div class="content">
                        <h3>{{$topic->name}}</h3>
                        <p>{{$topic->description}}</p>
                    </div>
                    <a class="btn btn-primary px-3" href="{{route('home.tutorials.default',$topic->name)}}">Learn
                        {{$topic->name}}</a>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</main>
@endsection