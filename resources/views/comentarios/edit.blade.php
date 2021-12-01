@extends('layouts.app')

@section('content')
<div class="container">


<form action="{{url('/comentarios/'.$comentarios->id)}}" method="post" enctype="multipart/form-data">
@csrf
{{method_field('PATCH')}}
@include('comentarios.comun',['modo'=>'Editar'])


</form>
</div>
@endsection