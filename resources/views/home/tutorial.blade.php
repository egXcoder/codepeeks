<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CodePeeks {{$tutorial->name}}</title>
    <link rel="stylesheet" href="{{mix('css/home.css')}}">
    <meta name="theme-color" content="#62abe4">
    <meta property="og:image" itemprop="image" content="{{asset($topic->image_url)}}" />
    <meta property="twitter:image" itemprop="image" content="{{asset($topic->image_url)}}" />
    <link rel="shortcut icon" type="image/jpg" href="{{asset('/images/favicon.ico')}}" />
</head>

<body>
    <div class="home" id="app">
        <div class="navs">
            <x-top-nav></x-top-nav>

            <nav class="bottom-nav">
                <div class="py-2 d-flex">
                    <a onclick="$('.tutorial-list-container').toggleClass('show')" class="sidebar-toggle-button">
                        <span></span>
                        <span></span>
                        <span></span>
                    </a>
                    <a href="/"><i class="fas fa-home"></i></a>
                    @foreach($nav_topics as $nav_topic)
                    <a href="{{route('home.tutorials.default',$nav_topic->name)}}">{{$nav_topic->name}}</a>
                    @endforeach
                </div>
            </nav>
        </div>

        <main class="tutorial-screen">
            <div>
                <div class="row no-gutters">
                    <div class="tutorial-list-container">
                        <div class="list">
                            <div class="header-container">
                                <img src="{{asset($topic->image_url)}}">
                                <h2 class="header">{{$topic->name}}</h2>
                            </div>
                            <div class="tutorial-list">
                                @forelse($topic->tutorials->sortBy('order') as $single)
                                <a class="@if($single->id == $tutorial->id) active @endif"
                                    href="{{route('home.tutorials.specific',[$topic->name,$single->name])}}">{{$single->name}}</a>
                                @empty
                                <p class="text-center">No Tutorials Yet</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                    <div class="content">
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

    </div>
    <script src="{{mix('js/home.js')}}"></script>
    <x-google-analytics></x-google-analytics>
</body>

</html>