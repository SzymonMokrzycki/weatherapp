@extends('layouts.app')

@section('content')
<div class="container-fluid">
<div class="row justify-content-center">
        <section id="bg" style="background-image:url('images/storm.jpg');">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-8 col-lg-6 col-xl-4">

                    <div class="card shadow-lg" style="color: #4B515D; border-radius: 35px;">
                    <div class="card-body p-4">

                        <div class="d-flex">
                        <h6 class="flex-grow-1">Warsaw</h6>
                        </div>

                        <div class="d-flex flex-column text-center mt-5 mb-4">
                        <h6 class="display-4 mb-0 font-weight-bold" style="color: #1C2331;"> 13°C </h6>
                        <span class="small" style="color: #868B94">Stormy</span>
                        </div>

                        <div class="d-flex align-items-center">
                        <div class="flex-grow-1" style="font-size: 1rem;">
                            <div><i class="fas fa-wind fa-fw" style="color: #868B94;"></i> <span class="ms-1"> 40 km/h
                            </span></div>
                            <div><i class="fa fa-tint" aria-hidden="true"></i> <span class="ms-1"> 84% </span>
                            </div>
                            <div><i class="fas fa-sun fa-fw" style="color: #868B94;"></i> <span class="ms-1"> 0.2h </span>
                            </div>
                        </div>
                        <div>
                            <img src="{{asset('images/stormy.png')}}"
                            width="100px">
                        </div>
                        </div>

                    </div>
                    </div>

                </div>
                </div>

            </div>
        </section>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-5">
                <div class="card-header bg-dark text-white">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-dark">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
