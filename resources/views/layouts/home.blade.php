<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CodePeeks</title>
    <link rel="stylesheet" href="{{mix('css/home.css')}}">
    <meta name="theme-color" content="#62abe4">
    @yield('head')
</head>

<body>
    <div class="home" id="app">
        <div class="navs">
            <x-top-nav></x-top-nav>

            <nav class="bottom-nav">
                <div class="px-4 py-2 d-flex">
                    <a onclick="$('.tutorial-list-container').toggleClass('show')" class="sidebar-toggle-button">
                        <span></span>
                        <span></span>
                        <span></span>
                    </a>
                    <a href="/"><i class="fas fa-home"></i></a>
                    @foreach($nav_topics as $topic)
                    <a href="{{route('home.tutorials.default',$topic->name)}}">{{$topic->name}}</a>
                    @endforeach
                </div>
            </nav>
        </div>

        @yield('main')

    </div>
    <script src="{{mix('js/home.js')}}"></script>
   <x-google-analytics></x-google-analytics>
</body>

</html>