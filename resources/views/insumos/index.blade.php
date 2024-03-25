<!-- Vista principal insumos -->
@extends('layouts.sidebar')

@section('content')
<!-- Estilos card body -->
    <style>
        .custom-card {
            max-width: 700px;
            margin: 0 auto;
            margin-top: 100px;
        }
    </style>

    <div id="main" class="main">

        <div class="page-meta">
            <h5>Insumos</h5>
            <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active">Insumos</li>
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
        @can('Crear-insumo')<!-- Permiso crear-insumos -->
            <section class="section">
                <div class="row">
                    <div class="col-lg-4">
                        <!-- Card body agregar insumo -->
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Agregar insumo</h5>
                                <a href="{{ route('insumos.create') }}" class="btn btn-warning">Nuevo</a>
                            </div>
                        </div>

                    </div>
            </section>
        @endcan
        @can('Ver-insumo')<!-- Permiso ver-insumos -->
            <div class="row layout-top-spacing">

                <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                    <div class="widget-content widget-content-area br-8">
                        <div class="table-responsive">
                            <table id="zero-config" class="table dt-table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <!-- Nombre de columnas -->
                                        <th scope="col">#</th>
                                        <th scope="col">Material-Categoria</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                </thead>j
                                <tbody>
                                    <!-- Datos de insumos -->
                                    @foreach ($insumos as $insumo)
                                        <tr>
                                            <td>{{ $insumo->id }}</td><!-- ID insumo -->
                                            <td>{{ $insumo->material->categoria}}</td><!-- Categoria -->
                                            <td>
                                                <!-- Acciones -->
                                                @can('Editar-insumo')<!-- Permiso editar-insumos -->
                                                    <a href="{{ route('insumos.edit', $insumo->id) }}"
                                                        class="btn btn-info  btn-sm">Editar</a>
                                                @endcan
                                                @can('Borrar-insumo')<!-- Permiso borrar-insumos -->
                                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                        data-bs-target="#modal-{{ $insumo->id }}">Eliminar</button>
                                                @endcan
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="modal-{{ $insumo->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <!-- Ventana emergente de eliminar insumo -->
                                                    <div class="modal-body">
                                                        Estas seguro de eliminar la insumo {{ $insumo->material_id }}?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form
                                                            action="{{ route('insumos.destroy', ['insumo' => $insumo->id]) }}"
                                                            method="POST">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Cerrar</button>
                                                            <button type="submit" class="btn btn-success">Aceptar</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endcan
        <div class="pagination justify-content-end">
            {!! $insumos->links() !!}
        </div>
    </div>
@endsection
