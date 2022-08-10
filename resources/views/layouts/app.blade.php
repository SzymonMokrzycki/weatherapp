<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body onload="click()">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-dark shadow-sm">
            <div class="container bg-secondary bg-gradient rounded-pill">
                <a class="navbar-brand text-white" style="text-shadow: 2px 1px black;" href="{{ url('/') }}">
                    {{ config('app.name', 'Weather app') }}
                </a>
                <div class="input-group">
                    <div class="form-outline">
                        <input type="search" id="form1" class="form-control" value="Warsaw" />
                    </div>
                    <a id="a" onclick="click()"><button type="button" class="btn btn-dark">
                        <i class="fa fa-search"></i>
                    </button></a>
                </div>
                <select id="place" class="btn btn-dark">
                    <option value="All places">All places</option>
                    <option value="Poland">Poland</option>
                    <option value="England">England</option>
                    <option value="London">London</option>
                </select>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link text-white" id="login" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link text-white" id="register" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                        <div class="nav-item">
                            <button type="button" style="width:100px; margin-top:1px;" class="btn btn-dark">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i> Add city
                            </button>
                        </div>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main>
            @yield('content')
        </main>
    </div>
    <script>
        function click(){
            let a = document.getElementById('a');
            let city = document.getElementById('form1').value;
            let weather = "", temp = "", humidity = "", wind = "";
            $.ajax({
                url: "http://localhost:8000/city/"+city,
                method: "GET",
                success: function (data){
                   weather = data.weather; 
                   temp = data.temperature;
                   humidity = data.humidity;
                   wind = data.wind;
                   document.getElementById('weather').innerHTML = weather;
                   document.getElementById('cityname').innerHTML = city;
                   document.getElementById('temp').innerHTML = temp+"°C";
                   document.getElementById('humidity').innerHTML = humidity+"%";
                   document.getElementById('wind').innerHTML = wind+" m/s";
                   let lower = weather.toLowerCase();
                   let path = "images/"+lower+".png";
                   //let img = '<img src="{{asset('/images/')}}" width="100">';
                   let img = "<img src='{{asset('"+path+"')}}' width='100'>";
                   console.log(path);
                   $('#icon').html(img);
                }
            });
        }
    </script>
</body>
</html>
