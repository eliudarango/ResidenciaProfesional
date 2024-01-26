@extends('layouts.sidebar')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('BIENVENIDO! ') }}{{ Auth::user()->name }}</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <p>
                            <strong>Sabías que:</strong>
                        </p>
                        {{ __('El departamento de Desarrollo Académico del Instituto Tecnológico de Oaxaca desempeña un papel crucial
                                            al planear, coordinar, controlar y evaluar las actividades destinadas al crecimiento y mejora del personal docente. 
                                            Su función principal consiste en asegurar que el desarrollo académico de los profesores se lleve a cabo de acuerdo 
                                            con las normas y lineamientos establecidos por la Secretaría de Educación Pública.') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
