<!-- Vista de Login -->
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
    <div class="auth-container d-flex justify-content-center align-items-center vh-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-8 col-12">
                    <div class="card mt-3 mb-3">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="text-center">
                                <!-- Logo del TEC -->
                                <img src="{{ asset('/Template/src/assets/img/logoTEC.png') }}" class="sidebar-logo"
                                    alt="logo" style="width: 80px; height: auto;">
                                    <!-- Logo del ITO -->
                                <img src="{{ asset('/Template/src/assets/img/logoITO.png') }}" class="sidebar-logo"
                                    alt="logo" style="width: 80px; height: auto;">
                                    <!-- Titulo del departamento -->
                                <h5> DEPARTAMENTO DE DESARROLLO ACADÉMICO</h5>
                            </div>
                            <div class="row">
                                <!-- Formulario -->
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="col-md-12 mb-3">

                                        <h5>Iniciar Sesión</h5>
                                        <p>Ingrese su correo electrónico y contraseña para iniciar sesión</p>

                                    </div>
                                    <!-- Correo electronico -->
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
                                    <!-- Contraseña -->
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
                                    <!-- Checkbod de recuerdame -->
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
                                    <!-- Button de iniciar session -->
                                    <div class="col-12">
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Iniciar Sesión') }}
                                            </button>
                                            <!-- Button de olvido de contraseña -->
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
    </div>
@endsection
