@extends('layout.promoter')

@section('style')

@stop

@section('title')
	Eventos destacados
@stop

@section('content')
  <table class="table table-bordered table-striped">
    <tr>
        <th>Evento</th>
        <th>Fecha Inicio</th>
        <th>Fecha Fin</th>
    </tr>
    <tr>
        <td>asd</td>
        <td>asd</td>  
        <td>asd</td>
    </tr>                      
  </table>
  <a href="{{url('promoter/highlights/create')}}"><button class="btn btn-info">Agregar Nuevo</button></a>
@stop

@section('javascript')

@stop