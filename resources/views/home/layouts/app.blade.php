<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CodePeek</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>

<body>
    <div class="home">
        <nav class="navbar">
            <div class="container-fluid">
                <div class="col-md-4 brand">
                    <a href="/" class="d-flex align-items-center">
                        <img src="{{asset('images/brand.png')}}" class="img-fluid" alt="">
                        <p class="mb-0">CodePeeks</p>
                    </a>
                </div>
                <div class="col-md-6">
                    <input type="search" class="form-control" placeholder="Search...">
                </div>
            </div>
        </nav>

        @yield('main')
        
        <footer>
            <div class="copyrights">
                <div class="container-fluid">
                    <div class="d-flex align-items-center">
                        <img src="{{asset('images/brand.png')}}" class="img-fluid" alt="">
                        <p>&copy;Copyrights 2021, Developed By <a href="https://github.com/egXcoder">AI</a>
                        </p>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>

</html>