
<h2>{{$modo}}</h2>


@if(count($errors)>0)
    <div class="alert alert-danger" role="alert">
        <ul>
           @foreach($errors->all() as $error)
                <li> {{$error}}</li>
           @endforeach
        </ul>
    </div>
    
@endif

<div class="form-group">
<label for="Nombre">Nombre: </label>
<input type="text" class="form-control" name="Nombre" value="{{isset ( $comentarios->Nombre)? $comentarios->Nombre:old('Nombre') }}" id="Nombre">
<br>
</div>

<div class="form-group">
<label for="Correo">Correo: </label>
<input type="text" class="form-control" name="Correo" value="{{isset  ($comentarios->Correo)? $comentarios->Correo:old('Correo') }}" id="Correo">
<br>
</div>

<div class="form-group">
<label for="Telefono">Telefono: </label>
<input type="text" class="form-control" name="Telefono" value="{{isset  ($comentarios->Telefono)? $comentarios->Telefono:old('Telefono') }}" id="Telefono">
<br>
</div>

<div class="form-group">
<label for="Comentario">Comentario: </label>
<input type="textarea" class="form-control" name="Comentario" value="{{isset  ($comentarios->Comentario)? $comentarios->Comentario:old('Comentario') }}" id="Comentario">
<br>
</div>

<div class="form-group">
<label for="Foto"></label>
@if(isset ($comentarios->Foto))
<img src="{{ asset('storage').'/'.$comentarios->Foto}}" width="100" alt="">
@endif
<input type="file" class="form-control" name="Foto" value="" id="Foto">
<br>
</div>



<input class="btn btn-success" type="submit" value="{{$modo}}" class="d-inline">
<br>
<br>

<a href="{{ url( 'comentarios' ) }}"class="btn btn-danger">Regresar</a>