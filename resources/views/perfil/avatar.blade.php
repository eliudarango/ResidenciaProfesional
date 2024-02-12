@extends('layouts.sidebar')

@section('content')
    <div class="page-meta">
        <h5>Perfil</h5>
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active"><a href="/perfil">Perfil</a></li>
                <li class="breadcrumb-item active">Editar</li>
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
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Editar perfil</h5>
                        <div class="col-xl-10 col-lg-12 col-md-8 mt-md-0 mt-4">
                            <form method="POST" action="{{ route('avatar.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="text-center user-info">
                                    <img src="/avatars/{{ Auth::user()->avatar }}" style="width: 150px; border-radius: 10%">
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <!-- Nombre de usuario -->
                                        <label for="inputNanme4" class="form-label">Nombre completo </label>
                                        <input type="text" class="form-control" name="name"
                                            value="{{ Auth::user()->name }}">
                                    </div>
                                    <div class="col-md-6">
                                        <!-- Correo electronico -->
                                        <label for="inputEmail4" class="form-label">Correo electronico</label>
                                        <input type="email" class="form-control"name="email"
                                            value="{{ Auth::user()->email }}">
                                    </div>
                                    <!-- Telefono -->
                                    <div class="col-md-6">
                                        <label for="inputPhone" class="form-label">Teléfono</label>
                                        <input type="tel" class="form-control" id="telefono" name="telefono"
                                            value="{{ Auth::user()->telefono }}">
                                    </div>
                                    <!-- Imagen de perfil-->
                                    <div class="col-md-6">
                                        <label for="inputAvatar" class="form-label">Imagen de perfil</label>
                                        <input id="avatar" type="file"
                                            class="form-control @error('avatar') is-invalid @enderror" name="avatar"
                                            value="{{ old('avatar') }}" required autocomplete="avatar"
                                            accept="image/png, image/jpeg, image/jpg, image/gif">
                                        @error('avatar')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 mt-4 text-center">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Guardar') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
