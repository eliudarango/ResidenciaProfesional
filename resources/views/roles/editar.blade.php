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
                    <li class="breadcrumb-item active"><a href="/roles">Roles</a></li>
                    <li class="breadcrumb-item active">Editar</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <div class="card custom-card">
            <div class="card-body">
                <h5 class="card-title">Editar rol</h5>
                <!-- Vertical Form -->
                <form class="row g-3" action="{{ route('roles.update', $role->id) }}" method="POST">
                    @method('PATCH')
                    @csrf
                    <div class="col-12">
                        <label for="inputNanme4" class="form-label">Nombre del rol </label>
                        <input type="text" class="form-control" name="name" value="{{ $role->name }}">
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="inputPassword4" class="form-label">Permisos del rol </label>
                            <br />
                            @foreach ($permission as $value)
                                <label class="form-check-label">
                                    {{ Form::checkbox('permission[]', $value->name, in_array($value->id, $rolePermissions) ? true : false) }}

                                    {{ $value->name }}
                                </label>
                                <br />
                            @endforeach
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
