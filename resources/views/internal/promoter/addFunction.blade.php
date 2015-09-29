@extends('layout.promoter')

@section('style')

@stop

@section('title')
    Nueva Función
@stop

@section('content')


        <div class="row">
          <div class="col-sm-8">
            <form class="form-horizontal" method="post">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Fecha inicio</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control">
                    </div>
                </div>    
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Fecha fin</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control">
                    </div>
                </div>    
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Hora inicio</label>
                    <div class="col-sm-10">
                        <input type="time" class="form-control">
                    </div>
                </div>      
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Hora fin</label>
                    <div class="col-sm-10">
                        <input type="time" class="form-control">
                    </div> 
                </div> 
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Repetición</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="sel1">
                            <option>Única vez</option>
                            <option>Diario(Lun-Vier)</option>
                            <option>Diario(Lun-Dom)</option>
                            <option>Semanal</option>
                            <option>Mensual</option>
                        </select>
                    </div>            
                </div>  
                <legend>Agregar zona:</legend>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Nombre</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputEmail3" placeholder="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Capacidad</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputEmail3" placeholder="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Precio</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputEmail3" placeholder="">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <a class="btn btn-info" >Agregar</a>
                        <button  type="reset" class="btn btn-info">Cancelar</button>
                    </div>
                </div>                                

                <table class="table table-bordered table-striped">
                    <tr>
                        <th>Nombre</th>
                        <th>Capacidad</th>
                        <th>Precio</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                    <tr>
                        <td>Zona vip</td>
                        <td>200</td>
                        <td>300.0</td>
                        <td>
                            <a class="btn btn-info"  title="Editar"><i class="glyphicon glyphicon-pencil"></i></a>
                        </td>   
                        <td>
                             <a class="btn btn-info"   title="Eliminar" ><i class="glyphicon glyphicon-remove"></i></a>
                         </td>
                    </tr>
                    <tr>
                        <td>Zona platea</td>
                        <td>200</td>
                        <td>300.0</td>
                        <td>
                            <a class="btn btn-info" title="Editar"><i class="glyphicon glyphicon-pencil"></i></a>
                        </td>   
                        <td>
                             <a class="btn btn-info"  title="Eliminar" ><i class="glyphicon glyphicon-remove"></i></a>
                         </td>
                    </tr>            

                </table>


                <legend>Agregar Promoción:</legend>                              
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Zona</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="sel1">
                            <option>Zona vip</option>
                            <option>Zona platea</option>
                        </select>
                    </div>            
                </div>  
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Promoción</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="sel1">
                            <option>Cmr puntos</option>
                            <option>Lunes de infarto</option>
                            <option>Pagaron ya</option>
                        </select>
                    </div>            
                </div>  
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <a class="btn btn-info">Agregar</a>
                    </div>
                </div>                                    
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>Nombre zona</th>
                        <th>Promoción</th>
                        <th>Eliminar</th>
                    </tr>
                    <tr>
                        <td>Zona vip</td>
                        <td>Cmr puntos</td>  
                        <td>
                             <a class="btn btn-info"   title="Eliminar" ><i class="glyphicon glyphicon-remove"></i></a>
                         </td>
                    </tr>
                    <tr>
                        <td>Zona vip</td>
                        <td>Lunes de infarto</td>
                        <td>
                             <a class="btn btn-info"  title="Eliminar" ><i class="glyphicon glyphicon-remove"></i></a>
                        </td>
                    </tr>            
                    <tr>
                        <td>Zona platea</td>
                        <td>Lunes de infarto</td>
                        <td>
                             <a class="btn btn-info"  title="Eliminar" ><i class="glyphicon glyphicon-remove"></i></a>
                        </td>
                    </tr>  
                </table>
                <legend>Funciones del evento:</legend>

                <table class="table table-bordered table-striped">
                    <tr>
                        <th>Fecha inicio</th>
                        <th>Hora inicio</th>
                        <th>Fecha fin</th>
                        <th>Hora fin</th>
                        <th>Repetición</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                            <tr>
                                <td>24/09/2015</td>  
                                <td>10:30 AM</td>  
                                <td>10/10/2015</td> 
                                <td>1:30 PM</td>  
                                <td>Diario(Lun-Dom)</td>
                                <td>
                                    <a class="btn btn-info" title="Editar"><i class="glyphicon glyphicon-pencil"></i></a>
                                </td>                                 
                                <td>
                                    <a class="btn btn-info"  title="Eliminar" ><i class="glyphicon glyphicon-remove"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>24/09/2015</td>  
                                <td>2:30 PM</td>  
                                <td>10/10/2015</td> 
                                <td>5:30 PM</td>  
                                <td>Diario(Lun-Vier)</td> 
                                <td>
                                    <a class="btn btn-info" title="Editar"><i class="glyphicon glyphicon-pencil"></i></a>
                                </td>                                  
                                <td>
                                    <a class="btn btn-info"  title="Eliminar" ><i class="glyphicon glyphicon-remove"></i></a>
                                </td>
                            </tr>
                </table>

              <div class="form-group">
                <div class="col-sm-offset-0 col-sm-10">
                  <a  class="btn btn-info" href="#" >Agregar función</a>
                  
                </div>
              </div>


              <div class="form-group">
                <div class="col-sm-offset-5 col-sm-10">
                  <a  class="btn btn-info" href="#"  >Guardar</a>
                  <button  type="reset" class="btn btn-info">Cancelar</button>
                </div>
              </div>


            </form>
          </div>
        </div>



@stop

@section('javascript')
  {!!Html::script('js/moment.js')!!}
  {!!Html::script('js/rangepicker.js')!!}
@stop