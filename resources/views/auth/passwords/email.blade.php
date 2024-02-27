<!--Vista de email -->
@extends('layouts.app')
<!--  -->
@section('contenido')
    <div class="auth-container d-flex justify-content-center align-items-center vh-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-8 col-12">
                    <div class="card mt-3 mb-3">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="text-center">
                                <!--Logo TEC  -->
                                <img src="{{ asset('/Template/src/assets/img/logoTEC.png') }}" class="sidebar-logo"
                                    alt="logo" style="width: 80px; height: auto;">
                                <!-- Logo ITO -->
                                <img src="{{ asset('/Template/src/assets/img/logoITO.png') }}" class="sidebar-logo"
                                    alt="logo" style="width: 80px; height: auto;">
                                    <!-- Titulo del departamento -->
                                <h5> DEPARTAMENTO DE DESARROLLO ACADÉMICO</h5>
                            </div>
                            <h6 class="card-subtitle mb-4 text-muted text-center">RESTABLECER CONTRASEÑA</h6>
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <!-- Formulario -->
                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf
                                <!--Correo electronico  -->
                                <div class="row mb-12">
                                    <div class="mb-3">
                                        <p>Ingrese su correo electrónico para recuperar su cuenta</p>
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
                                 <!--Button para restablecer contraseña  -->
                                <div class="row mb-0">
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Enviar enlace para restablecer contraseña') }}
                                        </button>
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
