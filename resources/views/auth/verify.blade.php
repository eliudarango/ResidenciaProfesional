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
                                @if (session('resent'))
                                    <div class="alert alert-success" role="alert">
                                        {{ __('Se ha enviado un nuevo enlace de verificación a su dirección de correo electrónico.') }}
                                    </div>
                                @endif

                                {{ __('Antes de continuar, consulte su correo electrónico para obtener un enlace de verificación.') }}
                                {{ __('Si no recibiste el correo electrónico') }},
                                <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                    @csrf
                                    <button type="submit"
                                        class="btn btn-link p-0 m-0 align-baseline">{{ __('haga clic aquí para solicitar otro') }}</button>.
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
