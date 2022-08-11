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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body onload="click()">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-dark shadow-sm">
            <div class="container bg-secondary bg-gradient rounded-pill">
                <a class="navbar-brand text-white" style="text-shadow: 2px 1px black;" href="{{ url('/') }}">
                    {{ config('app.name', 'Weather app') }}
                </a>
                @auth
                <div class="input-group">
                    <div class="form-outline">
                        <!--<input type="search" id="form1" class="form-control" value="Warsaw" />-->
                        <select oninput="options()" class="form-control" id="place" multiple="multiple">
                        </select>
                    </div>
                    <button type="button" class="btn btn-dark" id="a" onclick="click()">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
                @endauth
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
        function options(){
            let input = document.getElementById('place').value;
            let array = input.split(", ");
            let city = array[0];
            let country = array[1];
            $.ajax({
                url: "http://localhost:8000/city/"+city+"/"+country,
                method: "GET",
                success: function (data){
                   array = data.con;
                   let option = [];
                   array.forEach(function(contr){
                        option += "<option value='"+contr+"'>"+contr+"</option>";
                   });
                }
            });
            $('#place').append(option);
        }

        function click(){
            let a = document.getElementById('a');
            let city = document.getElementById('place').value;
            let weather = "", temp = "", humidity = "", wind = "", country = "", array = [];
            $.ajax({
                url: "http://localhost:8000/city/"+city,
                method: "GET",
                success: function (data){
                   weather = data.arr.weather; 
                   temp = data.arr.temperature;
                   humidity = data.arr.humidity;
                   wind = data.arr.wind;
                   country = data.arr.country;
                   description = data.arr.description;
                   //console.log(array);
                   $('#place').append(option);
                   document.getElementById('weather').innerHTML = description;
                   document.getElementById('cityname').innerHTML = city+", "+country;
                   document.getElementById('temp').innerHTML = temp+"°C";
                   document.getElementById('humidity').innerHTML = humidity+"%";
                   document.getElementById('wind').innerHTML = wind+" m/s";
                   let lower = weather.toLowerCase();
                   let path = "images/"+lower+".png";
                   //let img = '<img src="{{asset('/images/')}}" width="100">';
                   let img = "<img src='{{asset('"+path+"')}}' width='100'>";
                   console.log(lower);
                   $('#icon').html(img);
                }
            });
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
    <script>
        $(document).ready(function() {
        $('#place').select2({
            theme: 'bootstrap-5',
            //dropdownParent: $('#form1')
        });
        });
    </script>
</body>
</html>
