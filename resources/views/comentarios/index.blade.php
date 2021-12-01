@extends('layouts.app')

@section('content')
<div class="container">

@if(Session::has('mensaje'))
{{Session::get('mensaje')}}
@endif

<a href="{{ url( 'comentarios/create' ) }}" class="btn btn-success">Registro</a>
<br>
<br>

<table class="table table-light">

    <thead class="thead-light">
        <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Telefono</th>
            <th>Comentario</th>
            <th>Foto</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
        @foreach($comentarios as $comentario)
        <tr>
            <td>{{$comentario->id}}</td>
            <td>{{$comentario->Nombre}}</td>
            <td>{{$comentario->Correo}}</td>
            <td>{{$comentario->Telefono}}</td>
            <td>{{$comentario->Comentario}}</td>
            <td>
              
            <img class="img-thumbnail" src="{{ asset('storage').'/'.$comentario->Foto}}" width="100" alt="">
            
            
            </td>
            <td>
            <a href="{{url('/comentarios/'.$comentario->id.'/edit')}}" class="btn btn-success">
                Editar
            </a>
 
            

                <form action="{{url('/comentarios/'.$comentario->id)}}" method="post" class="d-inline">
                @csrf
                {{method_field('DELETE')}}

                
                <input class="btn btn-danger" type="submit" onclick="return confirm('¿Desea borrar esta informacion?')" value="Borrar">
                </form>
            </td>
        </tr>     
        @endforeach  
    </tbody>
</table>
</div>
@endsection 