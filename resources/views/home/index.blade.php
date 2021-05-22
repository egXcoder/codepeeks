<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CodePeeks</title>
    <link rel="stylesheet" href="{{mix('css/home.css')}}">
    <meta name="theme-color" content="#62abe4">
    <meta property="og:image" itemprop="image" content="{{asset('images/brand.png')}}" />
    <meta property="twitter:image" content="{{asset('images/brand.png')}}">
    <meta property="og:description"
        content="CodePeeks is a web application where you can reach peeks on various topics of software development" />
    <meta property="twitter:description"
        content="CodePeeks is a web application where you can reach peeks on various topics of software development" />
</head>

<body>
    <div class="home" id="app">
        <div class="navs position-static">
            <x-top-nav></x-top-nav>
        </div>

        <main class="index">
            <section class="welcome">
                <img src="{{asset('images/design.png')}}">
            </section>
            <section class="all-topics">
                <div class="container">
                    <div class="header-container">
                        <h1 class="header">Topics</h1>
                        <img src="{{asset('images/peek.jpg')}}">
                    </div>
                    <hr class="mt-0">
                    <div class="row">
                        @foreach($topics as $topic)
                        <div class="col-lg-4 col-md-3 col-sm-6">
                            <div class="topic">
                                <span class="count">{{$topic->tutorials_count}}</span>
                                <img src="/{{$topic->image_url}}" class="img-fluid">
                                <div class="content">
                                    <h3>{{$topic->name}}</h3>
                                    <p>{{$topic->description}}</p>
                                </div>
                                <a class="btn btn-primary px-3"
                                    href="{{route('home.tutorials.default',$topic->name)}}">Learn
                                    {{$topic->name}}</a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>
        </main>
    </div>
    <script src="{{mix('js/home.js')}}"></script>
    <x-google-analytics></x-google-analytics>
</body>

</html>