@extends('layout.salesman')

@section('style')

@stop

@section('title')
  Bienvenido vendedor
@stop

@section('content')


<p>Ten un buen dia</p>
<br>
<a  class="btn btn-info" href="{{url('salesman/password')}}">Restaurar contraseña</a>


@stop

@section('javascript')

@stop

@section('content')
  <!-- Contenido-->