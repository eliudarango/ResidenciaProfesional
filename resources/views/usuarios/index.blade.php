<!-- Vista principal usuarios -->
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
            <h5>Usuarios</h5>
            <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active">Usuarios</li>
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
        @can('Crear-usuarios')
            <!-- Permiso crear-usuarios -->
            <section class="section">
                <div class="row">
                    <div class="col-lg-4">
                        <!-- Card body agregar usuario -->
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Agregar usuario</h5>
                                <a href="{{ route('usuarios.create') }}" class="btn btn-warning">Nuevo</a>
                            </div>
                        </div>

                    </div>
            </section>
        @endcan
        @can('Ver-usuarios')
            <!-- Permiso ver-usuarios -->
            <div class="row layout-top-spacing">

                <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                    <div class="widget-content widget-content-area br-8">
                        <!-- Cuadro de búsqueda -->
                        <div class="col-lg-8 col-md-8 col-sm-9 filtered-list-search mx-auto mb-3">
                            <form class="form-inline my-2 my-lg-0 justify-content-center" action="{{ route('usuarios.index') }}"
                                method="GET">
                                <div class="input-group">
                                    <input type="text" class="form-control product-search br-30" name="search"
                                        id="search" placeholder="Buscar..." value="{{ request('search') }}">
                                    <button class="btn btn-primary" type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-search">
                                            <circle cx="11" cy="11" r="8"></circle>
                                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                        </svg>
                                    </button>
                                </div>
                            </form>
                        </div>

                        <div class="table-responsive">
                            <table id="zero-config" class="table dt-table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <!-- Nombre de columnas -->
                                        <th scope="col">#</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Correo electronico</th>
                                        <th scope="col">Teléfono</th>
                                        <th scope="col">Rol</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Datos de usuarios -->
                                    @foreach ($usuarios as $usuario)
                                        <tr>
                                            <td>{{ $usuario->id }}</td><!-- ID usuario -->
                                            <td>
                                                <div class="avatar me-2">
                                                    <img alt="avatar" src="/avatars/{{ $usuario->avatar }}"
                                                        class="rounded-circle" />
                                                </div>

                                                {{ $usuario->name }}
                                            </td><!-- Nombre de usuario -->
                                            <td>{{ $usuario->email }}</td><!-- Correo de usuario -->
                                            <td>{{ $usuario->telefono }}</td><!-- Telefono de usuario -->
                                            <td><!-- Rol de usuario -->
                                                <p class="mb-0">Puesto</p>
                                                <span class="text-info">
                                                    @if (!empty($usuario->getRoleNames()))
                                                        @foreach ($usuario->getRoleNames() as $rolName)
                                                            {{ $rolName }}
                                                        @endforeach
                                                    @endif
                                                </span>
                                            </td>
                                            <td>
                                                <!-- Acciones -->
                                                @can('Editar-usuarios')
                                                    <!-- Permiso editar-usuarios -->
                                                    <a href="{{ route('usuarios.edit', $usuario->id) }}"
                                                        class="btn btn-info  btn-sm">Editar</a>
                                                @endcan
                                                @can('Borrar-usuarios')
                                                    <!-- Permiso borrar-usuarios -->
                                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                        data-bs-target="#modal-{{ $usuario->id }}">Eliminar</button>
                                                @endcan
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="modal-{{ $usuario->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <!-- Ventana emergente de eliminar usuario -->
                                                    <div class="modal-body">
                                                        Estas seguro de eliminar el usuario {{ $usuario->name }}?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form
                                                            action="{{ route('usuarios.destroy', ['usuario' => $usuario->id]) }}"
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
            {!! $usuarios->links() !!}
        </div>
    </div>
@endsection
