@extends('layout.salesman')

@section('style')
    {!!Html::style('css/seats.css')!!}
    <style type="text/css">
        .boxy{
            position: relative; 
            bottom: 10px;
        }
    </style>
@stop

@section('title')
	Nueva Venta - Entradas
@stop

@section('content')
   
    <fieldset>
        <legend>Información del evento</legend>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        <br>
        <div class="select Type"> 
            <label>
                <div style="-webkit-columns: 100px 3;">
                    <h4 class="boxy"> Codigo del Evento </h4>
                    {!! Form::text('code', '09213241', ['class' => 'form-control boxy', 'disabled']) !!}
                    <h4> Nombre del Evento </h4>
                    {!! Form::text('name', 'Piaf de Pam Gems', ['class' => 'form-control', 'disabled']) !!}
                    <h4>Entradas Disponibles</h4>
                    {!! Form::text('available', '520', ['class' => 'form-control', 'disabled']) !!}  
                </div>
                <div style="-webkit-columns: 100px 3;">
                    <h4 class="boxy"> Fecha del Evento </h4>
                    {!! Form::select('date', ['18 Octubre', '19 Octubre', '20 Octubre'], null, ['class' => 'form-control boxy']) !!}
                    <h4> Hora </h4>
                    {!! Form::select('hour', ['19:00', '21:00'], null, ['class' => 'form-control']) !!}
                    <h4> Zona del Evento </h4>
                    {!! Form::select('zone', ['VIP', 'Platea'], null, ['class' => 'form-control']) !!}
                </div>
                <h4> Promoción </h4>
                {!! Form::select('date', ['Ninguna', 'Pre-venta', 'Visa Platinium'], null, ['class' => 'form-control']) !!}
            </label>
        </div>
        <br>
        <div class="table-responsive">
          <table class="table table-bordered" style="widht:1px">
            <thead>
                <tr>
                    <th>Zona</th>
                    <th>Precio</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>VIP</td>  
                    <td>S/.150.00</td>
                </tr>
                <tr>
                    <td>VIP Pre-venta</td>  
                    <td>S/.135.00</td>
                </tr>
                <tr>
                    <td>Platea</td>  
                    <td>S/.70</td>
                </tr>
                <tr>
                    <td>Platea - %30 descuento con Visa Platinium</td>  
                    <td>S/.49</td>
                </tr>
            </tbody>
          </table>
        </div>
        <fieldset>
        <legend>Información del cliente</legend>
        <div style="-webkit-columns: 100px 2;">
            <h5>Ingrese Usuario</h5>
            <div class="input-group" style="width:290px">
                {!! Form::text('number', null, ['class' => 'form-control', 'placeholder' => 'Documento de Identidad...']) !!}
                <span class="input-group-btn">
                    <button class="btn btn-info" type="button">Buscar</button>
                </span>
            </div><!-- /input-group -->
            <h5>Nombre de Cliente</h5>
            {!! Form::text('name', 'Peppa', ['class' => 'form-control', 'disabled']) !!}
        </div>
            
            <!--<input type="submit" value="Submit">-->
            <br>
            <br>
        </fieldset>
        <legend>Selección de Ubicación</legend>
        <h5>Zona:</h5>
        {!! Form::text('zoneSelected', 'VIP', ['class' => 'form-control', 'disabled']) !!}
        <br>
        <div class="seats">
            <div class="demo">
                <div id="seat-map">
                    <div class="front">Escenario</div>                  
                </div>
                <br>
                <div class="booking-details">
                    <h4 style="text-decoration:underline;text-align: center;">Resumen</h4>
                    <p>Evento: <span> Piaf de Pam Gems</span></p>
                    <p>Día: <span>Octubre 13, 21:00</span></p>
                    <p>Asiento(s): </p>
                    <ul id="selected-seats"></ul>
                    <p>Tickets: <span id="counter">0</span></p>
                    <p>Total: <b>S/.<span id="total">0</span></b></p>
                    <div id="legend"></div>
                </div>
                <div style="clear:both"></div>
           </div>
        </div>
        <!-- Content Row -->
        <!-- /.row -->
        <hr>
        <div class= "button-final">
            <!--<button type="button" class="btn btn-info" data-toggle="modal" data-target="#pay" data-whatever="@mdo">Pago Tarjeta</button>    
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#cash" data-whatever="@mdo">Pago Efectivo</button>-->
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#mix2" data-whatever="@mdo">Realizar Pago</button>
            <button type="button" class="btn btn-info">Cancelar Venta</button>
            <button type="button" class="btn btn-info" data-dismiss="modal" data-target="#visualizarVenta"><i class="glyphicon glyphicon-print"></i></button>
            <!--<div class="modal fade" id="pay" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
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
                                    <label>Número de Tarjeta</label>
                                    {!! Form::text('number', '', ['class' => 'form-control', 'placeholder' => '1234 5678 9012 3456']) !!}
                                    <label>Fecha de expiración</label>
                                    {!! Form::text('expiration', '', ['class' => 'form-control', 'placeholder' => 'mm/aa']) !!}
                                    <label for="exampleInputEmail2">Código de Seguridad</label>
                                    {!! Form::text('code', '', ['class' => 'form-control', 'placeholder' => '123']) !!}
                                  </div>
                                  <button type="button" class="btn btn-info" data-dismiss="modal" data-toggle="modal" data-target="#end" data-whatever="@mdo">Pagar Entrada</button>
                                  <button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button>
                              </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>  
            
            <div class="modal fade" id="cash" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
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
                                    <label for="exampleInputEmail2">Tipo de Cambio: S/.2.90</label>
                                    <br>
                                    <label for="exampleInputEmail2">Monto Ingresado</label>
                                    {!! Form::text('amount', '', ['class' => 'form-control', 'placeholder' => '100.00']) !!}
                                    <br>
                                    <label for="exampleInputEmail2">Monto a Pagar</label>
                                    {!! Form::text('pay', '', ['class' => 'form-control', 'placeholder' => '90/00']) !!}
                                    <label for="exampleInputEmail2">Vuelto</label>
                                    {!! Form::text('return', '', ['class' => 'form-control', 'placeholder' => '10.00', 'disabled']) !!}
                                  </div>
                                  <button type="button" class="btn btn-info" data-dismiss="modal" data-toggle="modal" data-target="#end" data-whatever="@mdo">Aceptar</button>
                                  <button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button>
                              </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div> -->
             <div class="modal fade" id="mix2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="exampleModalLabel">Detalle de Pago:</h4>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-group">
                                    <label for="exampleInputEmail2">Monto a Pagar</label>
                                    <input type="text" class="form-control" placeholder="S/.150.00" readonly="">
                                    <br>
                                    <div class="form-group checkbox pay">
                                        <label><input type="checkbox" value="">Pago con tarjeta</label>
                                        <hr>
                                        <label for="exampleInputEmail2">Número de Tarjeta</label>
                                        <input type="number" class="form-control" placeholder="1234 5678 9012 3456">
                                        <label for="exampleInputEmail2">Fecha de expiración</label>
                                        <input type="date" class="form-control" placeholder="mm/aa">
                                        <label for="exampleInputEmail2">Código de Seguridad</label>
                                        <input type="number" class="form-control" placeholder="123">
                                        <label for="exampleInputEmail2">Monto a pagar con tarjeta</label>
                                        <input type="number" class="form-control" placeholder="110.00">
                                    </div>
                                    <br>
                                    <div class="form-group checkbox pay">
                                        <label><input type="checkbox" value="">Pago con efectivo</label>
                                        <h5>Tipo de Cambio: S/.2.90</h5>
                                        <hr>
                                        <label for="exampleInputEmail2">Monto Ingresado</label>
                                        <input type="text" class="form-control" placeholder="S/.50.00">
                                        <label for="exampleInputEmail2">Vuelto</label>
                                        <input type="text" class="form-control" placeholder="S/.10.00" readonly>
                                        <br>
                                        <button type="button" class="btn btn-info" data-dismiss="modal" data-toggle="modal" data-target="#end" data-whatever="@mdo">Pagar Entrada</button>
                                        <button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="end" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="exampleModalLabel">Fin de venta</h4>
                        </div>
                        <div class="modal-body">
                            <form>
                              <div class="form-group">
                                  <div class="form-group">
                                    <label for="exampleInputEmail2">Venta exitosa!</label>
                              </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>      
        </div>
    </fieldset>    
@stop

@section('javascript')
	{!!Html::script('js/jquery.seat-charts.min.js')!!}
	{!!Html::script('js/seats.js')!!}
@stop