@extends('home.layouts.app')

@section('main')
<main class="index">
    <section class="all-topics">
        <div class="container">
            <h1>All Topics</h1>
            <hr>
            <div class="row">
                @foreach($topics as $topic)
                <div class="col-lg-4 col-md-3 col-sm-6 topic">
                    <img src="/{{$topic->image_url}}" class="img-fluid">
                    <div class="content">
                        <h3>{{$topic->name}}</h3>
                        <p>{{$topic->description}}</p>
                    </div>
                    <a class="btn btn-primary px-3" href="{{route('home.tutorials',$topic->name)}}">Learn
                        {{$topic->name}}</a>
                </div>
                @endforeach
            </div>
        </div>

    </section>
</main>
@endsection