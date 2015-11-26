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
          <th>Organizdor</th>
          <th>Promotor</th>
          <th>Monto pagado</th>
          <th>Fecha de pago</th>
        </tr>
        @foreach($payments as $payment)
        <tr>
          <td><a href="{{ url('promoter/event/'.$payment->event_id) }}">{{$payment->event["name"]}}</a></td>
          <td>{{$payment->event->organization["organizerName"]}} {{$payment->event->organization["organizerLastName"]}}</td>
          <td><a href="#">{{$payment->promoter["name"]}} {{$payment->promoter["lastname"]}}</a></td>
          <td>S/ {{$payment->paid}}</td>
          <td>{{$payment->created_at}}</td>
        </tr>
        @endforeach
      </table>
@stop

@section('javascript')

@stop