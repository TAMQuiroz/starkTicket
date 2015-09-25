@extends('layout.salesman')

@section('style')
    {!!Html::style('css/seats.css')!!}
@stop

@section('title')
	Entradas
@stop

@section('content')
    <h3>Cobrar Reserva</h3>

    <fieldset>
        <legend>Información del cliente</legend>
        <h5>Ingrese Código de Reserva</h5>
        <div class="input-group" style="width:290px">
            <input type="text" class="form-control" placeholder="Código de reserva...">
            <span class="input-group-btn">
                <button class="btn btn-info" type="button">Buscar</button>
            </span>
        </div><!-- /input-group -->
        <br>
        <h5>Detalle de Reserva:</h5>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        <br>
        <div class= "button-final">
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#pay" data-whatever="@mdo">Pago Tarjeta</button>    
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#cash" data-whatever="@mdo">Pago Efectivo</button>
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
                              <button type="button" class="btn btn-info" data-dismiss="modal" data-toggle="modal" data-target="#end" data-whatever="@mdo">Pagar Entrada</button>
                              <button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button>
                          </div>
                        </form>
                    </div>
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
                                <input type="text" class="form-control" placeholder="S/.100.00">
                                <br>
                                <label for="exampleInputEmail2">Monto a Pagar</label>
                                <input type="text" class="form-control" placeholder="S/.90.00">
                                <label for="exampleInputEmail2">Vuelto</label>
                                <input type="text" class="form-control" placeholder="S/.10.00" readonly>
                              </div>
                              <button type="button" class="btn btn-info" data-dismiss="modal" data-toggle="modal" data-target="#end" data-whatever="@mdo">Aceptar</button>
                              <button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button>
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
    <br><br>
    <h3>Nueva Venta</h3>
    <fieldset>
        <legend>Información del evento</legend>
        <div class="select Type"> 
            
            <label>
                <h4> Codigo del Evento </h4>
                <input class="form-control" style="width:290px" id="disabledInput" type="text" value="09213241" disabled>
                <h4> Nombre del Evento </h4>
                <input class="form-control" type="text" name="firstname" value="Piaf de Pam Gems" disabled>
                <h4> Fecha del Evento </h4>
                <select class="form-control">
                    <option value="">18 Octubre</option>
                    <option value="saab">19 Octubre</option>
                    <option value="mercedes">20 Octubre</option>
                </select>
                <h4> Hora </h4>
                <select class="form-control">
                    <option value="">21:00</option>
                    <option value="saab">18:00</option>
                </select>
                <h4> Zona del Evento </h4>
                <select class="form-control">
                    <option value="">VIP</option>
                    <option value="saab">Platea</option>
                </select>
                <h4>Entradas Disponibles</h4>
                <input class="form-control" type="text" name="firstname" value="520" disabled>
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
                    <td>S/150.00</td>
                </tr>
                <tr>
                    <td>Platea</td>  
                    <td>S/.70</td>
                </tr>
            </tbody>
          </table>
        </div>
        <fieldset>
        <legend>Información del cliente:</legend>
            <h5>Ingrese Usuario</h5>
            <div class="input-group" style="width:290px">
                <input type="text" class="form-control" placeholder="Código de usuario...">
                <span class="input-group-btn">
                    <button class="btn btn-info" type="button">Buscar</button>
                </span>
            </div><!-- /input-group -->
            <br><br>
            <h5>Nombre de Cliente:</h5>
            <input class="form-control" style="width:290px" id="disabledInput" type="text" value="Peppa" disabled>
            <!--<input type="submit" value="Submit">-->
            <br>
            <br>
        </fieldset>
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
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#pay" data-whatever="@mdo">Pago Tarjeta</button>    
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#cash" data-whatever="@mdo">Pago Efectivo</button>
            <button type="button" class="btn btn-info">Cancelar Venta</button>
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
                              <button type="button" class="btn btn-info" data-dismiss="modal" data-toggle="modal" data-target="#end" data-whatever="@mdo">Pagar Entrada</button>
                              <button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button>
                          </div>
                        </form>
                    </div>
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
                                <input type="text" class="form-control" placeholder="S/.100.00">
                                <br>
                                <label for="exampleInputEmail2">Monto a Pagar</label>
                                <input type="text" class="form-control" placeholder="S/.90.00">
                                <label for="exampleInputEmail2">Vuelto</label>
                                <input type="text" class="form-control" placeholder="S/.10.00" readonly>
                              </div>
                              <button type="button" class="btn btn-info" data-dismiss="modal" data-toggle="modal" data-target="#end" data-whatever="@mdo">Aceptar</button>
                              <button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button>
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