@extends('layout.client')

@section('style')
@stop

@section('title')
	Historial de eventos
@stop

@section('content')
    <table class="table table-bordered table-striped">
        <tr>
            <th>Fecha del presentación</th>
            <th>Cancelado?</th>
            <th>Nombre del Evento</th>
            <th>Número de Tickets</th>
            <th>Costo Total</th>
            <th>Código de reserva</th>
            <th>Fecha de pago</th>
        </tr>
        @foreach($tickets as $ticket)
        <tr>
           <td>{{date("d/m/Y", $ticket->presentation["starts_at"])}} </td>
           <td>@if ($ticket->cancelled) Si @else No @endif</td>
           <td><a href="{{ url ('event/'.$ticket->event_id) }}">{{$ticket->event["name"]}}</a></td>
           <td>{{$ticket->quantity}}</td>
           <td>s/. {{$ticket->total_price}}</td>
           <td>{{$ticket->reserve}}</td>
           <td>{{$ticket->payment_date}}</td>
        </tr>
        @endforeach
    </table>
    {!!$tickets->render()!!}
@stop

@section('javascript')
@stop