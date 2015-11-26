@extends('layout.client')

@section('style')
@stop

@section('title')
Perfil
@stop

@section('content')
<div class="col-sm-3">
    <img src="{{$obj->image}}" class="img-responsive user-photo" >
    <p class="text-info text-center">Foto de perfil</p>
</div>
<div class="col-sm-4">
    <p><b>Nombre</b>: {{$obj->lastname}}, {{$obj->name}}</p>
    <p><b>
    @if($obj->di_type == 1)
        DNI
    @else
        @if($obj->di_type == 2)
        Carnet de Extranjeria
        @else
        Pasaporte
        @endif
    @endif
    </b> {{$obj->di}}</p>
    <p><b>Dirección: </b>{{$obj->address}}</p>
    <p><b>Teléfono:</b> {{$obj->phone}}</p>
    <p><b>E-mail:</b> {{$obj->email}}</p>
</div>
<div class="col-sm-4">
    <br>
</div>
<div class="col-sm-12">
    <hr>
<p class="text-center"><a class="btn btn-info" href="{{url('client/edit')}}">Editar </a> <a  class="btn btn-info" href="{{url('client/password')}}">Restaurar contraseña</a> <a type="button" class="btn btn-info" href="{{url('client/photo')}}">Cambiar foto</a></p>
</div>
@stop

@section('javascript')

@stop