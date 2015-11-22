@extends('layout.promoter')

@section('style')

@stop

@section('title')
Bienvenido promotor de ventas
@stop

@section('content')
<legend>Eventos creados</legend>

<div class="table-responsive">

  <table class="table table-bordered table-striped">
      <tr>
          <th>Fecha del Evento</th>
          <th>Nombre del Evento</th>
          <th>Detalles</th>
      </tr>
      @foreach($events as $event)
      <tr>
         <td>{{date("d/m/Y", $event->presentation["starts_at"])}} </td>
         <td>{{$event->name}}</td>
         <td><a href="{{ url ('promoter/event/'.$event->id) }}" class="label label-info" title="Mostrar mas detalles">Detalles</a></td>
      </tr>
      @endforeach
  </table>
</div>

{!!$events->render()!!}
@stop

@section('javascript')

@stop
