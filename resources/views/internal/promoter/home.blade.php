@extends('layout.promoter')

@section('style')

@stop

@section('title')
Bienvenido promotor de ventas
@stop

@section('content')

<legend>Eventos vigentes</legend>

<div class="table-responsive">

<table class="table table-bordered table-striped">
    <tr>
        <th>Nombre del Evento</th>
        <th>Fecha de creación</th>
        <th>Fecha publición</th>
        <th>Fecha de inicio de ventas</th>
        <th>Detalles</th>
    </tr>
    @foreach($events as $event)
    <tr>
       <td>{{$event->name}}</td>
       <td>{{$event->created_at}}</td>
       <td>{{date("d/m/Y",$event->publication_date)}} </td>
       <td>{{date("d/m/Y",$event->selling_date)}} </td>
       <td><a href="{{ url ('promoter/event/'.$event->id) }}"><button  class="btn btn-info" title="Mostrar mas detalles">Detalles</button></a></td>
    </tr>
    @endforeach
</table>

</div>

{!!$events->render()!!}
@stop

@section('javascript')

@stop
