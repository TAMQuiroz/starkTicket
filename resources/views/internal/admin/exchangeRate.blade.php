@extends('layout.admin')

@section('style')

@stop

@section('title')
	Tipo de cambio
@stop

@section('content')
            <div class="row">
                <div class="col-sm-8">
                  {!!Form::open(array('url' => 'admin/config/exchange_rate','files'=>true,'id'=>'form','class'=>'form-horizontal'))!!}
                   <div class="form-group"> 
                      
                         <label for="inputEmail3" class="col-sm-4 control-label">Nuevo tipo de Cambio: Compra</label>
                          <!--<input type="text" name="username" class="form-control"> -->
                          <div class="col-sm-6">
                             {!!Form::input('text','buyingRate', null ,['class'=>'form-control','id'=>'buyingRate','required','min' >0])!!}
                          </div>
                           <div class="col-sm-2"> </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-4 control-label">Nuevo tipo de Cambio: Venta</label>

                    <div class="col-sm-6">
                        {!!Form::input('text','sellingRate', null ,['class'=>'form-control','id'=>'sellingRate','required','min' >0])!!}      
                    </div>
                    <div class="col-sm-2"> </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-2"><br>
                      <a class="btn btn-info" href="" title="submit" data-toggle="modal" data-target="#submitModal" >Modificar Tipo Cambio</a>
                          <!--<button type="button" class="btn btn-info"  data-toggle="modal" data-target="#myModal">Modificar Tipo Cambio</button>-->
                    </div>
                  </div>
                  <div class="modal fade"  id="submitModal">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">¿Estas seguro que Modificar el Tipo de Cambio </h4>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-info" data-dismiss="modal">No</button>
                          <button id="yes" type="submit" class="btn btn-info">Si</button>
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
                  {!!Form::close()!!}
                </div>
            </div>
            <hr>
            <h3>Ultimos tipos de cambio</h3>
                <table class="table table-bordered table-striped">
                          
                          <tr>
                            <th>Precio Compra</th>
                            <th>Precio Venta</th>
                            <th>Fecha Inicio</th>
                            <th>Fecha Fin</th>
                          </tr>
                 
                          @foreach($exchangeRates as $exchangeRate)
                          <tr>
                            <td>{{$exchangeRate->buyingRate}}</td>
                            <td>{{$exchangeRate->sellingRate}}</td>
                        
                            <td>{{$exchangeRate->startDate}}</td>
                            <td>{{$exchangeRate->finishDate}}</td>
                            
                          </tr>
                          @endforeach 
                </table>
                {!!$exchangeRates->render()!!}

              <!--
                        <nav>
                    <ul class="pagination">
                      <li>
                        <a href="#" aria-label="Previous">
                          <span aria-hidden="true">&laquo;</span>
                        </a>
                      </li>
                      <li><a href="#">1</a></li>
                      <li><a href="#">2</a></li>
                      <li><a href="#">3</a></li>
                      <li><a href="#">4</a></li>
                      <li><a href="#">5</a></li>
                      <li>
                        <a href="#" aria-label="Next">
                          <span aria-hidden="true">&raquo;</span>
                        </a>
                      </li>
                    </ul>
                  </nav>
             
                <div id="myModal" class="modal fade" role="dialog">
                  <div class="modal-dialog">

                  
                    <div class="modal-content">
                      <div class="modal-body">
                        <h2>Mensaje del Sistema</h2>
                        <h3>Su Tipo de Cambio ha sido Guardado con Éxito</h3>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
                      </div>
                    </div>

                  </div>
                </div>-->
@stop

@section('javascript')

@stop