@extends('layout.client')

@section('style')
@stop

@section('title')
	Historial de eventos
@stop

@section('content')
    <table class="table table-bordered table-striped">
        <tr>
            <th>Fecha del Evento</th>
            <th>Nombre del Evento</th>
            <th>Número de Tickets</th>
            <th>Costo Total</th>
        </tr>
        @foreach($tickets as $ticket)
        <tr>
           <td>{{date("d/m/Y", $ticket->presentation["starts_at"])}} </td>
           <td>{{$ticket->event["name"]}}</td>
           <td>{{$ticket->quantity}}</td>
           <td>s/. {{$ticket->total_price}}</td>
        </tr>
        @endforeach
    </table>
    {!!$tickets->render()!!}
@stop

@section('javascript')
@stop