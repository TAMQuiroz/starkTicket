@extends('layout.client')

@section('style')
    {!!Html::style('css/seats.css')!!}
@stop

@section('title')
	Compra de Entradas
@stop

@section('content')
	<div class="buy">
		<legend>Selección fecha y horario</legend>
		<div class="chooser">
        <select class="form-control" style="width:260px;display:inline-block">
            <option value="">13 de Octubre</option>
            <option value="saab">14 de Octubre</option>
            <option value="mercedes">15 de Octubre</option>
        </select>
        <select class="form-control" style="width:260px;display:inline-block">
            <option value="">21:00</option>
            <option value="saab">18:00</option>
        </select>
        <h5>Selecciona Zona</h5>
        <select class="form-control" style="width:260px;display:inline-block">
            <option value="">VIP</option>
            <option value="saab">Platea</option>
        </select>
        <h5> Promoción </h5>
        <select class="form-control" style="width:260px;display:inline-block">
            <option value="">Ninguna</option>
            <option value="saab">Pre-venta</option>
            <option value="saab">Visa Platinium</option>
        </select>
	</div>
	<legend>Selección de Ubicación</legend>
    <h5>Zona:</h5>
    <input class="form-control" style="width:290px" type="text" name="firstname" value="VIP" disabled>
    <br>
	<div class="seats">
		<div class="demo">
   			<div id="seat-map">
				<div class="front">Escenario</div>					
			</div>
			<div class="booking-details">
				<p>Evento: <span> Piaf de Pam Gems</span></p>
				<p>Día: <span>Octubre 13, 21:00</span></p>
				<p>Asiento(s): </p>
				<ul id="selected-seats"></ul>
				<p>Tickets: <span id="counter">0</span></p>
				<p>Total: <b>S/.<span id="total">0</span></b></p>
						
				<button type="button" class="btn btn-info" data-toggle="modal" data-target="#pay" data-whatever="@mdo">Comprar Entrada</button>
				<!--<button type="button" class="btn btn-info"><a href="{{url('event/successBuy')}}">Comprar Entrada</a></button>-->
				<div class="modal fade" id="pay" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
			        <div class="modal-dialog" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					        <h4 class="modal-title" id="exampleModalLabel">Detalle de Pago:</h4>
					    </div>
					    <div class="modal-body">
					    	<h5>Total a Pagar: s/.300.00</h5>
					    	<hr>	
					        <form>
					          <div class="form-group">
								  <div class="form-group">
								    <label for="exampleInputEmail2">Número de Tarjeta</label>
								    <input type="text" class="form-control" placeholder="1234 5678 9012 3456">
								  	<label for="exampleInputEmail2">Fecha de expiración</label>
								  	<input type="text" class="form-control" placeholder="mm/aa">
								  	<label for="exampleInputEmail2">Código de Seguridad</label>
								  	<input type="text" class="form-control" placeholder="123">
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
			</div>
			<div style="clear:both"></div>
	</div>

@stop

@section('javascript')
	{!!Html::script('js/jquery.seat-charts.min.js')!!}
	{!!Html::script('js/seats.js')!!}
	
@stop