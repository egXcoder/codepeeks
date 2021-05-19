<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">
</head>

<body>
    <div class="admin">
        <div class="row no-gutters">
            <div class="col-md-2">
                <div class="commands-container">
                    <a class="d-flex align-items-center p-2 header" href="{{route('admin.index')}}">
                        <img src="{{asset('images/brand.png')}}" style="height: 50px;text-align:center;">
                        <p class="mb-0 text-decoration-none">Administration</p>
                    </a>
                    <div class="commands">
                        <a class="action @if(Route::currentRouteName() == 'admin.index') active @endif"
                            href="{{route('admin.index')}}"><i class="fas fa-home"></i>
                            Dashboard</a>
                        <a class="action @if(Route::currentRouteName() == 'admin.topics.index') active @endif"
                            href="{{route('admin.topics.index')}}"><i class="fas fa-border-all"></i> All
                            Topics</a>
                        <form action="{{route('logout')}}" method="POST">
                            @csrf
                            <button class="btn btn-link action"><i class="fas fa-sign-out-alt"></i> Logout</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-10 p-4">
                @yield('main')
            </div>
        </div>
    </div>
    <script src="{{asset('js/admin.js')}}"></script>

    @yield('js')
</body>


</html>