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
            {!! Form::text('code', null, array('class' => 'form-control', 'placeholder'=>'Código de reserva..')) !!} 
            <span class="input-group-btn">
                <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#detail">Buscar</button>
            </span>
        </div><!-- /input-group -->
        <div id="detail" class="collapse">
            <br>
            <h5>Detalle de Reserva:</h5>
            <div class="table-responsive">
              <table class="table table-bordered" style="widht:1px">
                <thead>
                    <tr>
                        <th>Evento</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Zona</th>
                        <th>Ubicación</th>
                        <th>Precio</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Piaf</td>
                        <td>13 Octubre 2015</td>
                        <td>9:00pm</td>
                        <td>VIP</td>  
                        <td>A14</td>
                        <td>S/150.00</td>
                    </tr>
                    <tr>
                        <td>Piaf</td>
                        <td>13 Octubre 2015</td>
                        <td>9:00pm</td>
                        <td>VIP</td>  
                        <td>A15</td>
                        <td>S/150.00</td>
                    </tr>
                </tbody>
              </table>
            </div>
        </div>
        
        <br>
        <div class= "button-final">
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#payOptions" data-whatever="@mdo">Realizar pago</button>  

            <div class="modal fade" id="payOptions" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="exampleModalLabel">Escoge el tipo de pago</h4>
                        </div>
                        <div class="modal-body">
                            <form>
                              <div class="form-group">
                                    <div class="form-group">

                                        <div class="radio">
                                             <label>
                                                <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                                                Pago tarjeta
                                              </label>
                                        </div>
                                        <div class="radio">
                                              <label>
                                                <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                                               Pago efectivo
                                              </label>
                                        </div>
                                        <div class="radio disabled">
                                              <label>
                                                <input type="radio" name="optionsRadios" id="optionsRadios3" value="option3">
                                                Pago mixto
                                              </label>
                                        </div>    
                                     <form>
                              <div class="form-group">
                                  <div class="form-group">
                                    <label for="exampleInputEmail2">Monto a Pagar</label>
                                    <input type="text" class="form-control" placeholder="S/.90.00" readonly="">
                                    <h4>Pago con tarjeta</h4>
                                    <label for="exampleInputEmail2">Número de Tarjeta</label>
                                    <input type="number" class="form-control" placeholder="1234 5678 9012 3456">
                                    <label for="exampleInputEmail2">Fecha de expiración</label>
                                    <input type="date" class="form-control" placeholder="mm/aa">
                                    <label for="exampleInputEmail2">Código de Seguridad</label>
                                    <input type="number" class="form-control" placeholder="123">
                                    <label for="exampleInputEmail2">Monto a pagar con tarjeta</label>
                                    <input type="number" class="form-control" placeholder="60">
                                  </div>
                                  
                              </div>
                              <div class="form-group">
                                  <div class="form-group">
                                    <h4>Pago con efectivo</h4>
                                    <h4>Tipo de Cambio: S/.2.90</h4>
                                    <label for="exampleInputEmail2">Monto Ingresado</label>
                                    <input type="text" class="form-control" placeholder="S/.100.00">
                                    <label for="exampleInputEmail2">Vuelto</label>
                                    <input type="text" class="form-control" placeholder="S/.10.00" readonly>
                                    <br>
                                    <button type="button" class="btn btn-info" data-dismiss="modal" data-toggle="modal" data-target="#end" data-whatever="@mdo">Pagar Entrada</button>
                                    <button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button>
                                    
                                  </div>
                              </div>
                            </form>
                            </form>
                        </div>
                    </div>
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
                                    <br><br>
                                    <button type="button" class="btn btn-info" data-dismiss="modal"  data-toggle="modal" data-target="#visualizar" data-whatever="@mdo"><i class="glyphicon glyphicon-print"></i></button>
                                  </div>  
                              </div>
                            </form>
                        </div>
                    </div>
                </div>         
        </div>


            <div class="modal fade" id="visualizar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="exampleModalLabel">Previsualización de impresión</h4>
                        </div>
                        <div class="modal-body">
                            <form>
                              <div class="form-group">
                                 <div class="form-group">

                                    <table class="table table-bordered" style="widht:1px">
                                        <thead>
                                            <tr>
                                                <th>Evento</th>
                                                <th>Fecha</th>
                                                <th>Hora</th>
                                                <th>Zona</th>
                                                <th>Ubicación</th>
                                                <th>Precio</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Piaf</td>
                                                <td>13 Octubre 2015</td>
                                                <td>9:00pm</td>
                                                <td>VIP</td>  
                                                <td>A14</td>
                                                <td>S/150.00</td>
                                            </tr>
                                            <tr>
                                                <td>Piaf</td>
                                                <td>13 Octubre 2015</td>
                                                <td>9:00pm</td>
                                                <td>VIP</td>  
                                                <td>A15</td>
                                                <td>S/150.00</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <br>
                                    <label for="exampleInputEmail2">Monto a Pagar</label>
                                    <input type="text" class="form-control" placeholder="S/.300.00" readonly="">
                                    <br>
                                    <button type="button" class="btn btn-info" data-dismiss="modal">Aceptar</button>
                                  </div>  
                              </div>
                            </form>
                        </div>
                    </div>
                </div>         
        </div>


    </fieldset>
    <br><br>

           
    </fieldset>    
@stop

@section('javascript')
	{!!Html::script('js/jquery.seat-charts.min.js')!!}
	{!!Html::script('js/seats.js')!!}
@stop