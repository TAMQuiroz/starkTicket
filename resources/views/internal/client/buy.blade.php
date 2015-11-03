@extends('layout.client')

@section('style')
    {!!Html::style('css/seats.css')!!}
    <style type="text/css">
    	.btn-info{
            background-color: #83D3C9;
            border-color: #83D3C9;
        }
        .btn-info:hover{
            background-color: #329DB7;
            border-color: #329DB7;
        }
        .form-control{
        	width: 360px;
        	display: inline-block;
        }
        label{
        	width: 180px;
        }
    </style>
@stop

@section('title')
	{{$event->name}}
@stop

@section('content')
	
	<div>
		<div class="chooser">
			{!!Form::hidden('event_id',$event['id'],['id'=>'event_id'])!!}
			<h5>Seleccione Funcion</h5>
	        {!! Form::select('presentation_id', $presentations, null, ['class' => 'form-control', 'id'=>'pres_selection']) !!}
	        <h5>Seleccione Zona</h5>
	        {!! Form::select('zone_id', $zones, null, ['class' => 'form-control','id'=>'zone_id']) !!}
		</div>
	</div>	
	<legend>Selección de Ubicación</legend>
    <br>
	<div class="seats">
		<div class="demo">
   			<div id="seat-map">
				<div class="front">Escenario</div>					
			</div>
			<div class="booking-details">
				
				<p>Día: {!! Form::text('selectedDate', 'Octubre 13, 21:00', ['class' => 'form-control', 'disabled']) !!}</p>
				<p>Asiento(s): </p>
				<ul id="selected-seats"></ul>
				<p>Tickets: <span id="counter">0</span></p>
				<p>Total: <b>S/.<span id="total">0</span></b></p>
				<div id="legend"></div>
						
				<button type="button" class="btn btn-info" data-toggle="modal" data-target="#pay" data-whatever="@mdo">Comprar Entrada</button>
				<div class="modal fade" id="pay" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
			        <div class="modal-dialog" role="document">
					    <div class="modal-content">
					    	<div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						        <h4 class="modal-title" id="exampleModalLabel">Detalle de Pago:</h4>
						    </div>
						    <div class="modal-body">
						    	<label>Total a Pagar:</label>
						    	{!! Form::text('total', 'S/. 300.00', ['class' => 'form-control', 'disabled']) !!}
						    	<hr>	
						        <form>
						          	<div class="form-group">
										<div class="form-group">
											<label>Número de Tarjeta</label>
											{!! Form::text('number', '', ['class' => 'form-control', 'placeholder' => '1234 5678 9012 3456']) !!}
											<label>Fecha de expiración</label>
											{!! Form::text('expiration', '', ['class' => 'form-control', 'placeholder' => 'mm/aa']) !!}
											<label for="exampleInputEmail2">Código de Seguridad</label>
											{!! Form::text('code', '', ['class' => 'form-control', 'placeholder' => '123']) !!}
										</div>
										<a href="{{url('event/successBuy')}}"><button type="button" class="btn btn-info">Pagar Entrada</button></a>
										<button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button>
							     	</div>
						        </form>
						    </div>
					    </div>
					</div>	
				</div>	
			</div>
			<div style="clear:both"></div>
	</div>

@stop

@section('javascript')
	{!!Html::script('js/jquery.seat-charts.min.js')!!}
	{!!Html::script('js/seats.js')!!}
	{!!Html::script('js/main.js')!!}
    <script type="text/javascript">
        var config = {
        routes: [
            { zone: "{{ URL::route('ajax.getClient') }}" },
            { price_ajax: "{{ URL::route('ajax.getPrice') }}" },
            { event_available: "{{URL::route('ajax.getAvailable')}}"},
            { slots: "{{URL::route('ajax.getSlots')}}"},
            { makeArray: "{{URL::route('ajax.getZone')}}"},
            { takenSlots: "{{URL::route('ajax.getTakenSlots')}}"},
            { promo: "{{URL::route('ajax.getPromo')}}"}
        ]
    };
    </script>
@stop