<!-- Vista principal inventarios -->
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
            <h5>Inventario</h5>
            <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active">Inventario</li>
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
        @can('Crear-inventario')<!-- Permiso crear-inventarios -->
            <section class="section">
                <div class="row">
                    <div class="col-lg-4">
                        <!-- Card body agregar inventario -->
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Agregar inventario</h5>
                                <a href="{{ route('inventarios.create') }}" class="btn btn-warning">Nuevo</a>
                            </div>
                        </div>

                    </div>
            </section>
        @endcan
        @can('Ver-inventario')<!-- Permiso ver-inventarios -->
            <div class="row layout-top-spacing">

                <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                    <div class="widget-content widget-content-area br-8">
                        <div class="table-responsive">
                            <table id="zero-config" class="table dt-table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <!-- Nombre de columnas -->
                                        <th scope="col">#</th>
                                        <th scope="col">Tipo</th>
                                        <th scope="col">Descripcion</th>
                                        <th scope="col">Numero serie</th>
                                        <th scope="col">Estado</th>
                                        <th scope="col">Mantenimiento</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Datos de inventarios -->
                                    @foreach ($inventarios as $inventario)
                                        <tr>
                                            <td>{{ $inventario->id }}</td><!-- ID inventario -->
                                            <td>{{ $inventario->tipo }}</td><!-- Tipo -->
                                            <td>{{ $inventario->descripcion }}</td><!-- descripcion -->
                                            <td>{{ $inventario->numero_serie }}</td><!-- numero de serie -->
                                            <td>
                                                @if ($inventario->estado == 1)
                                                    <span class="badge badge-light-success">Disponible</span>
                                                @else
                                                    <span class="badge badge-light-danger">No disponible</span>
                                                @endif
                                            </td><!-- estado -->
                                            <td>
                                                @if ($inventario->mantenimiento == 1)
                                                    <span class="badge badge-light-danger">En mantenimiento</span>
                                                @else
                                                    <span class="badge badge-light-success"></span>
                                                @endif
                                            </td><!-- mantenimiento -->
                                            <td>
                                                <!-- Acciones -->
                                                @can('Editar-inventario')<!-- Permiso editar-inventarios -->
                                                    <a href="{{ route('inventarios.edit', $inventario->id) }}"
                                                        class="btn btn-info  btn-sm">Editar</a>
                                                @endcan
                                                @can('Borrar-inventario')<!-- Permiso borrar-inventarios -->
                                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                        data-bs-target="#modal-{{ $inventario->id }}">Eliminar</button>
                                                @endcan
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="modal-{{ $inventario->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <!-- Ventana emergente de eliminar inventario -->
                                                    <div class="modal-body">
                                                        Estas seguro de eliminar el inventario {{ $inventario->descripcion }}?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form
                                                            action="{{ route('inventarios.destroy', ['inventario' => $inventario->id]) }}"
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
            {!! $inventarios->links() !!}
        </div>
    </div>
@endsection
