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

        <div class="page-meta">
            <h5>Roles</h5>
            <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item active"><a href="/roles">Roles</a></li>
                    <li class="breadcrumb-item active">Registrar</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <div class="card custom-card">
            <div class="card-body">
                <h5 class="card-title">Registrar Rol</h5>
                <!-- Vertical Form -->
                <form class="row g-3" action="{{ route('roles.store') }}" method="POST">
                    @csrf
                    <div class="col-12">
                        <label for="inputNanme4" class="form-label">Nombre del rol </label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="inputPassword4" class="form-label">Permisos del rol </label>
                            <br />
                            @foreach ($permission as $value)
                                <label class="form-check-label">
                                    {{ Form::checkbox('permission[]', $value->name, false, ['class' => 'name']) }}
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
