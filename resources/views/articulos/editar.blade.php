<!-- Vista editar articulos -->
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
                    <li class="breadcrumb-item active"><a href="/usuarios">Articulos</a></li>
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
                <h5 class="card-title">Editar articulo</h5>
                <!--Formulario -->
                <form class="row g-3" action="{{ route('articulos.update', $articulo->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="col-12">
                        <!-- Material -->
                        <label for="material">Material:</label>
                        <select name="material_id" id="material" required>
                            @foreach ($materiales as $material)
                                <option value="{{ $material->id }}"
                                    {{ $articulo->material_id == $material->id ? 'selected' : '' }}>
                                    {{ $material->categoria }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12">
                        <!-- Numero de serie -->
                        <label for="inputDescripcion4" class="form-label">Numero de serie </label>
                        <input type="text" class="form-control" name="numero_serie"
                            value="{{ $articulo->numero_serie }}" required>
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
