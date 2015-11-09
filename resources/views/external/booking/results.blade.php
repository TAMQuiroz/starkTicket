@extends('layout.client')
@section('style')
	<style type="text/css">
        .btn-info{
            background-color: #83D3C9;
            border-color: #83D3C9;
        }
        .btn-info:hover{
            background-color: #329DB7;
            border-color: #329DB7;
        }
    </style>
	
@stop
@section('title')
	Reserva exitosa
@stop

@section('content')


<h4>Su reserva se realizó con éxito.</h4>
<label>Evento: </label> {{$event->name}}
<br>
<label>Fecha</label> {{$eventDate}}
<br>
<label>Zona</label> {{$zone->name}}
<br>
<label>Cantidad de entradas</label> {{$cant}}
<br>
@if($event->place->rows != null)
	<label>Asientos:</label> 
	@foreach($seats as $seat)
		<br>
		&nbsp; F{{$seat->row}}C{{$seat->column}}
	@endforeach
	
@endif
	

	<!--<h5> Su código de Reserva es 2134415674 y ha sido enviado a su correo electrónico </h5>	-->
	<br><br>
	 
<form action="{{action('BookingController@sendConfirmationMail',$codigo)}}" enctype="multipart/form-data">		
	<td><button type="submit" class="btn btn-info" >Enviar información al Correo</button></td>
</form>
	<td><a href={{url('event/'.$event->id)}}><button type="button" class="btn btn-info">Finalizar</button></a></td>

@stop

@section('javascript')
@stop