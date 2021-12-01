

@extends('layouts.app')

@section('content')
<div class="container">

<form action="{{url('/comentarios')}}" method="post" enctype="multipart/form-data">
@csrf
@include('comentarios.comun',['modo'=>'Crear'])

</form>
</div>
@endsection