@extends('layouts.sidebar')

@section('content')
    <style>
        .custom-card {
            max-width: 700px;
            margin: 0 auto;
            margin-top: 100px;
        }
    </style>

    <div id="main" class="main">

        <div class="pagetitle">
            <h1>Usuario</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active"><a href="/usuarios">Usuarios</a></li>
                    <li class="breadcrumb-item active">Registrar</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <div class="card custom-card">
            <div class="card-body">
                <h5 class="card-title">Registrar Usuario</h5>
                <!-- Vertical Form -->
                <form class="row g-3" action="{{ route('usuarios.store') }}" method="POST">
                    @csrf
                    <div class="col-12">
                        <label for="inputNanme4" class="form-label">Nombre completo </label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="col-12">
                        <label for="inputEmail4" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email">
                    </div>
                    <div class="col-12">
                        <label for="inputPassword4" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                    <div class="col-12">
                        <label for="inputPassword4" class="form-label">Confirmar contraseña</label>
                        <input type="password" class="form-control" name="confirm-password">
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="inputPassword4" class="form-label">Rol</label>
                            {!! Form::select('roles[]', $roles, [], ['class' => 'form-select']) !!}
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </form><!-- Vertical Form -->
            </div>
        </div>
    </div>
@endsection
