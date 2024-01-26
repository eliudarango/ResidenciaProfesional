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
            <h1>Usuarios</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active">Usuarios</li>
                </ol>
            </nav>
        </div>
        @can('crear-usuarios')
            <section class="section">
                <div class="row">
                    <div class="col-lg-4">

                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Agregar usuario</h5>
                                <a href="{{ route('usuarios.create') }}" class="btn btn-warning">Nuevo</a>
                            </div>
                        </div>

                    </div>
            </section>
        @endcan
        @can('ver-usuarios')
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Rol</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usuarios as $usuario)
                        <tr>
                            <td>{{ $usuario->id }}</td>
                            <td>{{ $usuario->name }}</td>
                            <td>{{ $usuario->email }}</td>
                            <td>
                                @if (!empty($usuario->getRoleNames()))
                                    @foreach ($usuario->getRoleNames() as $rolName)
                                        {{ $rolName }}
                                    @endforeach
                                @endif
                            </td>
                            <td>
                                @can('editar-usuarios')
                                    <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-info  btn-sm">Editar</a>
                                @endcan
                                @can('borrar-usuarios')
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
                                    <div class="modal-body">
                                        Estas seguro de eliminar el usuario {{ $usuario->name }}?
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ route('usuarios.destroy', ['usuario' => $usuario->id]) }}"
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
        @endcan
        <div class="pagination justify-content-end">
            {!! $usuarios->links() !!}
        </div>
    </div>
@endsection
