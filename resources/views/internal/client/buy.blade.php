@extends('layout.client')

@section('style')
    {!!Html::style('css/seats.css')!!}
@stop

@section('title')
	Compra de Entradas
@stop

@section('content')
	<div class="buy">
		<div class="chooser">
		<h4>Selecciona fecha y horario</h4>
		<div class="dropdown">
            <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown"> 13 de Octubre
            <span class="caret"></span></button>
            <ul class="dropdown-menu">
                <li><a href="#">14 de Octubre</a></li>
                <li><a href="#">15 de Octubre</a></li>
                <li><a href="#">16 de Octubre</a></li>
            </ul>
        </div>
        <div class="dropdown">
            <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown"> 21:00
            <span class="caret"></span></button>
            <ul class="dropdown-menu">
                <li><a href="#">18:00</a></li>
            </ul>
        </div>
        <br>
        <h4>Selecciona Zona</h4>
        <div class="dropdown">
		  <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown">VIP
		  <span class="caret"></span></button>
		  <ul class="dropdown-menu">
		    <li><a href="#">Platea</a></li>
		  </ul>
		</div>
	</div>
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
								  <button type="button" class="btn btn-info"><a href="{{url('event/successBuy')}}">Pagar Entrada</a></button>
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