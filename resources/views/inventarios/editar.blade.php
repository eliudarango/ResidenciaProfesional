<!-- Vista editar inventarios -->
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
            <h5>Inventario</h5>
            <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active"><a href="/usuarios">Inventario</a></li>
                    <li class="breadcrumb-item active">Editar</li>
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
                <h5 class="card-title">Editar inventario</h5>
                <!--Formulario -->
                <form class="row g-3" action="{{ route('inventarios.update', $inventario->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="col-12">
                        <!-- Tipo -->
                        <label for="inputTipo4" class="form-label">Tipo </label>
                        <input type="text" class="form-control" name="tipo" value="{{ $inventario->tipo }}">
                    </div>
                    <div class="col-12">
                        <!-- Descripcion -->
                        <label for="inputDescripcion4" class="form-label">Descripcion </label>
                        <input type="text" class="form-control" name="descripcion" value="{{ $inventario->descripcion }}">
                    </div>
                    <div class="col-12">
                        <!-- Numero serie -->
                        <label for="inputnumeroserie4" class="form-label">Numero de serie </label>
                        <input type="text" class="form-control" name="numero_serie" value="{{ $inventario->numero_serie }}">
                    </div>
                    <div class="col-12">
                        <!-- Estado -->
                        <label class="form-label">Estado</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="estado" id="estado_activo" value="1" {{ $inventario->estado == 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="estado_activo">Disponible</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="estado" id="estado_inactivo" value="0" {{ $inventario->estado == 0 ? 'checked' : '' }}>
                            <label class="form-check-label" for="estado_inactivo">No disponible</label>
                        </div>
                    </div>
                    
                    <div class="col-12">
                        <!-- Mantenimiento -->
                        <label class="form-label">Mantenimiento</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="mantenimiento" id="mantenimiento_si" value="1" {{ $inventario->mantenimiento == 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="mantenimiento_si">Sí</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="mantenimiento" id="mantenimiento_no" value="0" {{ $inventario->mantenimiento == 0 ? 'checked' : '' }}>
                            <label class="form-check-label" for="mantenimiento_no">No</label>
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
