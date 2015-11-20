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
          <th>Fecha</th>
          <th>Monto pagado</th>
          <th>Detalles</th>
        </tr>
        @foreach($payments as $payment)
        <tr>
          <td>{{$payment->event["name"]}}</td>
          <td>{{$payment->event->organization["organizerName"]}} {{$payment->event->organization["organizerLastName"]}}</td>
          <td><a href="#">{{$payment->promoter["name"]}} {{$payment->promoter["lastname"]}}</a></td>
          <td>{{$payment->date_delivery}}</td>
          <td>S/ {{$payment->paid}}</td>
          <td><a href="{{ url ('promoter/transfer_payments/'.$payment->id  )}}" class="btn btn-primary">+</a></td>
        </tr>
        @endforeach
      </table>
@stop

@section('javascript')

@stop