@extends('layout.client')

@section('style')
	{!!Html::style('css/seats.css')!!}
@stop

@section('title')
	Nueva Reserva
@stop

@section('content')
    <form action="{{action('BookingController@store')}}" enctype="multipart/form-data">		
       <!-- Content -->
        <div class="row">

            <div class="seats">
                <div class="demo">
                    <h4> Fecha del Evento </h4>
                     <select class="form-control">
                         <option value="">18 Octubre</option>
                         <option value="saab">19 Octubre</option>
                         <option value="mercedes">20 Octubre</option>
                     </select>
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

                     <!--<button class="checkout-button">Comprar</button>-->

                        <div id="legend"></div>
                    </div>
                    <div style="clear:both"></div>
                    <input type="submit" value="Finalizar Reserva" style="float:right">
                </div>
            </div>

        </div>
    </form>

    <form action="{{action('BookingController@store')}}" enctype="multipart/form-data">     
       <!-- Content -->
        <div class="row">

            <div class="seats">
                <div class="demo">
                    <h4> Fecha del Evento </h4>
                     <select class="form-control">
                         <option value="">18 Octubre</option>
                         <option value="saab">19 Octubre</option>
                         <option value="mercedes">20 Octubre</option>
                     </select>
                     <h4> Selecciona una Zona </h4>
                    <select class="form-control">
                         <option value="">Platea - S/. 100</option>
                         <option value="saab">VIP - S/. 300</option>
                         <option value="mercedes">Tribuna - S/.50</option>
                     </select>
                     <h4> Selecciona la cantidad de entradas </h4>
                     <input type="number" min="1" max="5" style="width 20%" value="1">
                    <input type="submit" value="Finalizar Reserva" style="float:right">
                </div>
            </div>

        </div>
    </form> 				
@stop

@section('javascript')
		
	{!!Html::script('js/jquery.seat-charts.min.js')!!}
	{!!Html::script('js/seats.js')!!}

@stop