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
    </style>
@stop

@section('title')
	Nueva Reserva
@stop

@section('content')
    <form action="{{action('BookingController@store')}}" enctype="multipart/form-data">		
       <!-- Content -->
        <h3>Piaf de Pam Gems</h3>
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
                
                <p>Día: <span>Octubre 13, 21:00</span></p>
                <p>Asiento(s): </p>
                <ul id="selected-seats"></ul>
                <p>Tickets: <span id="counter">0</span></p>
                <p>Total: <b>S/.<span id="total">0</span></b></p>
                <div id="legend"></div>
                        
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#pay" data-whatever="@mdo">Reservar Entradas</button>
                <!--<button type="button" class="btn btn-info"><a href="{{url('event/successBuy')}}">Comprar Entrada</a></button>-->
                <div class="modal fade" id="pay" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="exampleModalLabel">Detalle de Reserva:</h4>
                        </div>
                        <div class="modal-body">
                            <h5>Total a Pagar: s/.300.00</h5>
                            <hr>    
                            <form>
                              <div class="form-group">
                                  <div class="form-group">
                                    <label for="exampleInputEmail2">Fecha de expiración</label>
                                    <input type="text" class="form-control" placeholder="mm/aa">
                                    <label for="exampleInputEmail2">Código de Seguridad</label>
                                    <input type="text" class="form-control" placeholder="123">
                                    <label for="exampleInputEmail2">Personas Autorizadas</label>
                                    <input type="text" class="form-control" placeholder="Juan Perez">
                                  </div>
                                  <a href="{{url('client/reservaexitosa')}}"><button type="button" class="btn btn-info">Reservar Entradas</button></a>
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



        <!--
       
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

                     

                        <div id="legend"></div>
                    </div>
                    <div style="clear:both"></div>
                    <input type="submit" value="Finalizar Reserva" style="float:right">
                </div>
            </div>

        </div>
    </form>

    <form action="{{action('BookingController@store')}}" enctype="multipart/form-data">     --> 
       <!-- Content -->
       <!--
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
    -->				
@stop

@section('javascript')
		
	{!!Html::script('js/jquery.seat-charts.min.js')!!}
	{!!Html::script('js/seats.js')!!}

@stop