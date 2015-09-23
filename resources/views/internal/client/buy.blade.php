@extends('layout.client')

@section('style')
    {!!Html::style('css/seats.css')!!}
@stop

@section('title')
	Comprar
@stop

@section('content')
	<div class="buy">
		<div class="chooser">
		<h3>Elige la fecha</h3>
		<br>
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
						
				<button class="checkout-button">Comprar</button>
						
				<div id="legend"></div>
			</div>
			<div style="clear:both"></div>
	   </div>

@stop

@section('javascript')
	{!!Html::script('js/jquery.seat-charts.min.js')!!}
	{!!Html::script('js/seats.js')!!}
	
@stop