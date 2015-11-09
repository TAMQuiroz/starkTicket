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
    @foreach($destacados as $destacado)
        <tr>
          <td>{{$destacado->event->name}}</td>
          <td> {{date('d-m-Y',strtotime($destacado->start_date))}}</td>
          <td> {{date('d-m-Y',strtotime($destacado->start_date)+($destacado->days_active*3600*24))}} </td>  
        </tr>
      @endforeach                     
  </table>
  <a href="{{url('promoter/highlights/create')}}"><button class="btn btn-info">Agregar Nuevo</button></a>
@stop

@section('javascript')

@stop