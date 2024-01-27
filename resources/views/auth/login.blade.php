@extends('layouts.app')

@section('contenido')
    <!-- BEGIN LOADER -->
    <div id="load_screen">
        <div class="loader">
            <div class="loader-content">
                <div class="spinner-grow align-self-center"></div>
            </div>
        </div>
    </div>
    <!--  END LOADER -->
    <div class="auth-container d-flex">

        <div class="container mx-auto align-self-center">

            <div class="row">

                <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-8 col-12 d-flex flex-column align-self-center mx-auto">
                    <div class="card mt-3 mb-3">

                        <div class="card-body">
                            <div class="text-center">
                                <img src="{{ asset('/Template/src/assets/img/logoTEC.png') }}" class="sidebar-logo"
                                    alt="logo" style="width: 80px; height: auto;">

                                <img src="{{ asset('/Template/src/assets/img/logoITO.png') }}" class="sidebar-logo"
                                    alt="logo" style="width: 80px; height: auto;">
                                    <h5> DEPARTAMENTO DE DESARROLLO ACADÉMICO</h5>
                            </div>
                            
                            <div class="row">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="col-md-12 mb-3">

                                        <h6>Iniciar Sesión</h6>
                                        <p>Ingrese su correo electrónico y contraseña para iniciar sesión</p>

                                    </div>
                                    <div class="row mb-12">
                                        <div class="mb-3">
                                            <label class="form-label">Correo Electronico:</label>

                                            <div class="col-md-12">
                                                <input id="email" type="email"
                                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                                    value="{{ old('email') }}" required autocomplete="email" autofocus>

                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-12">
                                        <div class="mb-3">
                                            <label class="form-label">Contraseña:</label>

                                            <div class="col-md-12">
                                                <input id="password" type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    name="password" required autocomplete="current-password">

                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-12">
                                        <div class="mb-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember"
                                                    id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                <label class="form-check-label" for="remember">
                                                    {{ __('Recuerdame') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Iniciar Sesión') }}
                                            </button>

                                            @if (Route::has('password.request'))
                                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                                    {{ __('¿Olvidaste tu contraseña?') }}
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
        </div>
    @endsection
