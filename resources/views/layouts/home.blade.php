<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CodePeeks</title>
    <link rel="stylesheet" href="{{mix('css/home.css')}}">
    <meta name="theme-color" content="#62abe4">
</head>

<body>
    <div class="home" id="app">
        <nav class="p-2">
            <div class="row justify-content-between align-items-center">
                <div class="col-sm-3 col-md-4 brand">
                    <a href="/" class="d-inline-flex align-items-center">
                        <img src="{{asset('images/brand.png')}}" class="img-fluid" alt="">
                        <p class="mb-0">Code Peeks</p>
                    </a>
                </div>
                <div class="col-sm-8 col-md-6">
                    <global-search></global-search>
                </div>
            </div>
        </nav>

        @yield('main')

        <footer>
            <div class="copyrights">
                <div class="container">
                    <div class="d-flex align-items-center">
                        <p>&copy;Copyrights 2021, Developed By <a href="https://github.com/egXcoder">AI</a>
                        </p>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <script src="{{asset('js/home.js')}}"></script>
</body>

</html>