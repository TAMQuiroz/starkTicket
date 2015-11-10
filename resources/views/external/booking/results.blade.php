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
	<td><button class="btn btn-info" data-toggle="modal" data-target="#send" data-whatever="@mdo">Enviar información al Correo</button></td>
</form>
	<td><a href={{url('event/'.$event->id)}}><button type="button" class="btn btn-info">Finalizar</button></a></td>
<!--
<div class="modal fade" id="send" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Ingrese Email:</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    {!!Form::input('email','',['class'=>'form-control'])!!}
                    <br>
                </div>
                <button type="submit" class="btn btn-info">Enviar</button>
            </div>
        </div>
    </div>
</div> -->
@stop

@section('javascript')
@stop