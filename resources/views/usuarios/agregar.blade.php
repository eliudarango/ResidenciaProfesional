<!-- Vista agregar usuarios -->
@extends('layouts.sidebar')

@section('content')
<!-- Estilos de card body -->
    <style>
        .custom-card {
            max-width: 700px;
            margin: 0 auto;
            margin-top: 100px;
        }
    </style>

    <div id="main" class="main">

        <div class="page-meta">
            <h5>Usuarios</h5>
            <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active"><a href="/usuarios">Usuarios</a></li>
                    <li class="breadcrumb-item active">Registrar</li>
                </ol>
            </nav>
            <!-- Mensajes session -->
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
        </div><!-- End Page Title -->
        <!-- Card body -->
        <div class="card custom-card">
            <div class="card-body">
                <h5 class="card-title">Registrar Usuario</h5>
                <!-- Formulario -->
                <form class="row g-3" action="{{ route('usuarios.store') }}" method="POST">
                    @csrf
                    <div class="col-12">
                        <!-- Nombre de usuario -->
                        <label for="inputNanme4" class="form-label">Nombre completo </label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="col-12">
                        <!-- Correo electronico -->
                        <label for="inputEmail4" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email">
                    </div>
                    <div class="col-12">
                        <!-- Contraseña -->
                        <label for="inputPassword4" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                    <div class="col-12">
                        <!-- Confirmacion de contraseña -->
                        <label for="inputPassword4" class="form-label">Confirmar contraseña</label>
                        <input type="password" class="form-control" name="confirm-password">
                    </div>
                    <div class="col-12">
                        <!-- Rol asignado -->
                        <div class="form-group">
                            <label for="inputPassword4" class="form-label">Rol</label>
                            {!! Form::select('roles[]', $roles, [], ['class' => 'form-select']) !!}
                        </div>
                    </div>
                    <div class="text-center">
                        <!-- Buttons -->
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </form><!-- Vertical Form -->
            </div>
        </div>
    </div>
@endsection
