<!-- Vista agregar inventarios -->
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
                    <li class="breadcrumb-item active"><a href="/usuarios">Inventarios</a></li>
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
                <h5 class="card-title">Registrar Inventario</h5>
                <!-- Formulario -->
                <form class="row g-3" action="{{ route('inventarios.store') }}" method="POST">
                    @csrf
                    <div class="col-12">
                        <!-- Descripcion -->
                        <label for="inputDescripcion4" class="form-label">Descripcion </label>
                        <input type="text" class="form-control" name="descripcion">
                    </div>
                    <div class="col-12">
                        <!-- Estado -->
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" id="estado" name="estado">
                            <label class="form-check-label" for="estado">
                                Estado
                            </label>
                        </div>
                    </div>
                    <div class="col-12">
                        <!-- Mantenimiento -->
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" id="mantenimiento"
                                name="mantenimiento">
                            <label class="form-check-label" for="mantenimiento">
                                Mantenimiento
                            </label>
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
