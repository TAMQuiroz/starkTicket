@extends('layout.promoter')

@section('style')

@stop

@section('title')
	Detalles de transferencia de pago
@stop

@section('content')
<p><b>Monto pagado</b>: s/ {{$payment->paid}}</p>
<p><b>Fecha de pago</b>: {{$payment->date_delivery}}</p>
<p><b>Fecha de creación</b>: {{$payment->created_at}}</p>
<p><b>Fecha de pago</b>: {{$payment->date_delivery}}</p>
<p><b>Evento</b>: <a href="{{url('event/'.$payment->event_id) }}">{{$payment->event["name"]}}</a></p>
@stop

@section('javascript')
@stop