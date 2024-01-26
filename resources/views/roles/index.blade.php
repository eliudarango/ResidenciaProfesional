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
    <h1>Roles</h1>
    <nav>
     <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item active">Roles</li>
    </ol>
    </nav>
  </div><!-- End Page Title -->


  @can('crear-rol')
  <div class="col-lg-4">
    <div class="card">
            <div class="card-body">
              <h5 class="card-title">Crear rol</h5>
              <a href="{{route ('roles.create') }}" class="btn btn-warning">Nuevo</a>
            </div>
    </div>
    
    
    </div>
    @endcan
    @can('ver-rol')
    <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Acciones</th>
                  </tr>
                </thead>
                <tbody>
              
                    @foreach($roles as $role)
                    <tr>
                        <td>{{$role->name}}</td>
                        
                        <td>
                            @can('editar-rol')
                            <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-info  btn-sm">Editar</a>
                            @endcan

                            @can('borrar-rol')
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modal-{{ $role->id}}">Eliminar</button>
                            @endcan
                           
                        </td>
                    </tr>

<div class="modal fade" id="modal-{{ $role->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       Estas seguro de eliminar el rol {{$role->name}}?
      </div>
      <div class="modal-footer">
      <form action="{{ route('roles.destroy', ['role' => $role->id]) }}" method="POST">
          @method('DELETE')
          @csrf
          
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          
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

 

  


</div>

    
@endsection