@extends('layout.client')

@section('style')
@stop

@section('title')
Perfil
@stop

@section('content')
<h4>Foto de perfil</h4>
<img src="{{$obj->image}}" width=100px>
<h4>Nombre</h4>
{{$obj->lastname}}, {{$obj->name}}
<h4>Documento Identidad</h4>
@if($obj->di_type == 1)
DNI
@else
Carnet de Extranjeria
@endif
{{$obj->di}}
<h4>Dirección</h4>
{{$obj->address}}
<h4>Teléfono</h4>
{{$obj->phone}}
<h4>E-mail</h4>
{{$obj->email}}
<br><br>
<!--<pre>
    {{$obj}}
</pre>-->

<p><a class="btn btn-info" href="{{url('client/edit')}}">Editar </a> | <a  class="btn btn-info" href="{{url('client/password')}}">Restaurar contraseña</a> | <a type="button" class="btn btn-info" href="{{url('client/photo')}}">Cambiar foto</a></p>
@stop

@section('javascript')

@stop