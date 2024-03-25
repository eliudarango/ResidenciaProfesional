<!-- Vista principal perfil password -->
@extends('layouts.sidebar')

@section('content')

<div id="main" class="main">
    <div class="page-meta">
        <h5>Cambiar contraseña</h5>
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active"><a href="/perfil">Perfil</a></li>
                <li class="breadcrumb-item active">Cambiar contraseña</li>
            </ol>
        </nav>
        <!-- Mensaje session -->
        @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first('error') }}
            </div>
        @endif
    </div>
    <br>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Cambiar contraseña</h5>
                        <div class="col-xl-10 col-lg-12 col-md-8 mt-md-0 mt-4">
                            <form method="POST" action="{{ route('perfil.store') }}">
                                @csrf
                                <span>*En seguida podrás cambiar tu contraseña actual del sistema, recuerda que debe 
                                    tener 8 caracteres como mínimo.</span>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="old_password" class="form-label">Contraseña actual</label>
                                            <input type="password" class="form-control" id="old_password"
                                                name="old_password">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="password" class="form-label">Contraseña nueva</label>
                                            <input type="password" class="form-control" id="password" name="password">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="password_confirmation" class="form-label">Confirmar nueva
                                                contraseña</label>
                                            <input type="password" class="form-control" id="password_confirmation"
                                                name="password_confirmation">
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-4 text-center">
                                        <button type="submit" class="btn btn-primary">
                                            Cambiar contraseña
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
</div>
@endsection
