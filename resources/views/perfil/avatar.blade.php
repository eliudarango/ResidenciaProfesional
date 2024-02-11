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
                    <div class="card-header">{{ __('Foto de perfil') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('avatar.store') }}" enctype="multipart/form-data">
                            @csrf

                            @if (session('success'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <div class="row mb-3">
                                <label for="avatar"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Avatar') }}</label>

                                <div class="col-md-6">
                                    <input id="avatar" type="file"
                                        class="form-control @error('avatar') is-invalid @enderror" name="avatar"
                                        value="{{ old('avatar') }}" required autocomplete="avatar">

                                    <img src="/avatars/{{ Auth::user()->avatar }}" style="width:80px;margin-top: 10px;">

                                    @error('avatar')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Cambiar imagen') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
