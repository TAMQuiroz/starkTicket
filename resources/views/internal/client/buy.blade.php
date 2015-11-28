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
{!!Form::open(array('route' => 'ticket.store.client','id'=>'form'))!!}
	<div>
		<div class="col-md-12">
			{!!Form::hidden('event_id',$event['id'],['id'=>'event_id'])!!}
			<div class="col-md-4">
				<h4>Seleccione Funcion</h5>
				@if($event->place->rows == null)
		        {!! Form::select('presentation_id', $presentations, null, ['class' => 'form-control', 'id'=>'pres_selection','onChange'=>'getAvailable()']) !!}
		        @else
		        {!! Form::select('presentation_id', $presentations, null, ['class' => 'form-control', 'id'=>'pres_selection','onChange'=>'getAvailable(); getTakenSlots()']) !!}
		        @endif
	        </div>
	        <div class="col-md-4">
		        <h4>Seleccione Zona</h5>
		        @if($event->place->rows == null)
		        {!! Form::select('zone_id', $zones, null, ['class' => 'form-control','id'=>'zone_id','onChange'=>'getAvailable(); getPromo()']) !!}
		        @else
				{!! Form::select('zone_id', $zones, null, ['class' => 'form-control','id'=>'zone_id','onChange'=>'getAvailable(); getPromo(); getTakenSlots()']) !!}
		        @endif
	        </div>
	        <div class="col-md-4">
				<h4 >Entradas Disponibles</h4>
        		{!! Form::text('available', null, ['id'=>'available','class' => 'form-control', 'disabled']) !!} 
	        </div>
		</div>
		{!! Form::hidden('promotion_id', null, ['id'=>'promotion_id']) !!}
        {!! Form::radio('payMode', config('constants.credit'), true,['style'=>'visibility: hidden']) !!}
	</div>
	
	<div class="table-responsive col-md-12" >
	    <table class="table table-bordered">
	        <thead>
	            <tr>
	                <th>Zona</th>
	                <th>Precio</th>
	            </tr>
	        </thead>
	        <tbody>
	            @foreach($event->zones as $zone)
	            <tr>
	                <td>{{$zone->name}}</td>
	                <td>S/. {{$zone->price}}</td>
	            </tr>
	            @endforeach
	        </tbody>
	    </table>
    </div>
    {!! Form::hidden('user_id', \Auth::user()->id, ['id'=>'user_id'])!!}

	@if($event->place->rows != null)

	<legend>Selección de Ubicación</legend>
    <br>
	<div class="col-md-12">
		<div class="demo">
			<div id="parent-map" class="col-md-8">
	   			<div id="seat-map"></div>
			</div>
			<div class="booking-details col-md-4">
				<h4 style="text-decoration:underline;text-align: center;">Resumen</h4>
				<p>Evento: <span> {{$event->name}}</span></p>
				<p>Asiento(s): </p>
				<ul id="selected-seats"></ul>
				<p>Tickets: <span id="counter">0</span></p>
				<p>Total: <b>S/.<span id="total">0</span></b></p>
				<div id="legend"></div>
			</div>
			<div style="clear:both"></div>
		</div>
	</div>
	{!!Form::hidden('seats',null,['id'=>'seats'])!!}
	<div class="col-md-6">
        Cantidad: {!!Form::number('quantity',0,['id'=>'quantity','readonly', 'class'=>'form-control'])!!}
    </div>
    @else
    <div class="col-md-6">
        Cantidad: {!!Form::number('quantity',0,['id'=>'quantity','class'=>'form-control','min'=>0])!!}
    </div>
    @endif
	<div class="col-md-6">
    	DNI designado: {!!Form::number('designee',null,['class'=>'form-control','min'=>0,'maxlength'=>8,'required'])!!}
    </div>
    <div class="col-md-12"><hr></div>
    <div class= "button-final col-md-12">
	    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#pay" data-whatever="@mdo" id="payModal" disabled onclick="getPromo()">Comprar Entrada</button>
	    <a href="{{url('client/home')}}"><button type="button" class="btn btn-info">Cancelar Venta</button></a>
		
		<div class="modal fade" id="pay" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
		    <div class="modal-dialog" role="document">
			    <div class="modal-content">
			    	<div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        <h4 class="modal-title" id="exampleModalLabel">Detalle de Pago:</h4>
				    </div>
				    <div class="modal-body">
				    	<label>Total a Pagar:</label>
				    	{!! Form::number('', null, ['id'=>'total2','class' => 'form-control', 'readonly', 'placeholder'=>'S/.']) !!}
				    	<hr>	
				        <form>
				          	<div class="form-group">
								<div class="form-group">
									<label>Número de Tarjeta</label>
									{!! Form::number('', null, ['id'=>'creditCardNumber','class' => 'form-control', 'placeholder' => '1234 5678 9012 3456','min'=>1,'max'=>9999999999999999,'required']) !!}
									<label>Fecha de expiración</label>
									<input type="date" id="expirationDate" class="form-control" min="{{date("Y-m-j")}}" required>
									<label for="exampleInputEmail2">Código de Seguridad</label>
									{!!Form::number('',null,['id'=>'securityCode','class'=>'form-control','placeholder'=>'123','min'=>0,'max'=>999,'required'])!!}
								</div>
								{!!Form::submit('Pagar Entrada',array('id'=>'yes','class'=>'btn btn-info'))!!}
								<button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button>
					     	</div>
				        </form>
				    </div>
			    </div>
			</div>	
		</div>
	</div>
{!!Form::close()!!}
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
    $('#yes').click(function(){
        $('#submitModal').modal('hide');  
    });
    </script>
@stop