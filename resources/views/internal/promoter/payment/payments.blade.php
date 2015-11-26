@extends('layout.promoter')

@section('style')

@stop

@section('title')
    Historial de pagos
@stop

@section('content')
     <table class="table table-bordered table-striped">
        <tr>
          <th>Evento</th>
          <th>Organizador</th>
          <th>Promotor</th>
          <th>Monto pagado</th>
          <th>Fecha de pago</th>
        </tr>
        @foreach($payments as $payment)
        <tr>
          <td><a href="{{ route('events.show', $payment->event['id']) }}" target="_self">{{$payment->event["name"]}}</a></td>
          <td>{{$payment->event->organization["organizerName"]}} {{$payment->event->organization["organizerLastName"]}}</td>
          <td>{{$payment->promoter["name"]}} {{$payment->promoter["lastname"]}}</td>
          <td>S/ {{$payment->paid}}</td>
          <td>{{$payment->created_at}}</td>
        </tr>
        @endforeach
      </table>
@stop

@section('javascript')

@stop