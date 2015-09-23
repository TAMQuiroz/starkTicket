@extends('layout.salesman')

@section('style')
    {!!Html::style('css/seats.css')!!}
@stop

@section('title')
	Venta de Entradas
@stop

@section('content')
	<fieldset>
            <legend>Información del cliente:</legend>
                Ingrese Usuario:<br>
                <input type="text" name="firstname" value="pp66">
                <button type="button" class="btn btn-info">Buscar</button>
                <br>
                Cliente: Peppa
                <!--<input type="submit" value="Submit">-->
                <br>
                <br>
        </fieldset>
        <fieldset>
            <legend>Información del evento:</legend>
            <div class="select Type"> 
                
                <label>
                    <h4> Codigo del Evento </h4>
                    <select>
                        <option value="">09213241</option>
                        <option value="saab">2342424</option>
                        <option value="mercedes">3131424</option>
                        <option value="audi">634346</option>
                        <option value="audi">O234215</option>
                    </select>
                </label>
                <br>
                <label>
                    <h4> Nombre del Evento </h4>
                    <input type="text" name="firstname" value="Piaf de Pam Gems">
                </label>
                <br>
                <label>
                    <h4> Fecha del Evento </h4>
                    <select>
                        <option value="">18 Octubre</option>
                        <option value="saab">19 Octubre</option>
                        <option value="mercedes">20 Octubre</option>
                    </select>
                </label>
            </div>
            <br>
            <h4> Precios y ubicaciones </h4>
            <p>
                VIP: 150
                <BR>
                PLATEA: 70
            </p>
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
                        
                <!--<button class="checkout-button">Comprar</button>-->
                        
                <div id="legend"></div>
            </div>
            <div style="clear:both"></div>
       </div>
    </div>
        <!-- Content Row -->
        <!-- /.row -->
        <hr>
        <div class= "button-final">
            <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo1">Comprar Tarjeta</button>
            <button type="button" class="btn btn-info">Comprar Efectivo</button>
            <button type="button" class="btn btn-info">Cancelar Venta</button>
            <div id="demo1" class="collapse">
            	<h5>Número de Tarjeta de Crédito</h5>
			    <input type="text"></input>
			    <h5>Código de Seguridad</h5>
			    <input type="text"></input>
			    <br>
			    <br>
			    <button type="button" class="btn btn-info">Pagar Entradas</button>
            </div>
        </div>
@stop

@section('javascript')
	{!!Html::script('js/jquery.seat-charts.min.js')!!}
	{!!Html::script('js/seats.js')!!}
@stop