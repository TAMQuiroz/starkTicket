@extends('layout.promoter')

@section('style')

@stop

@section('title')
	Pagos de transferencias
@stop

@section('content')


        <div class="row">
          <div class="col-sm-8">
            <form class="form-horizontal" method="post">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Nombre evento</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputEmail3" placeholder="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Categoría</label>
                    <div class="col-sm-10">
                    <select class="form-control" id="sel1">
                        <option>Concierto</option>
                        <option>Teatro</option>
                        <option>Ferias y Circo</option>
                        <option>Otros</option>
                    </select>
                    </div>      
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-11">
                      <button type="button" class="btn btn-info">Buscar</button>
                    </div>
                </div>                
                

                <table class="table table-bordered table-striped">
                    <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Categoría</th>
                        <th>Organizador</th>
                        <th>Pagar</th>
                    </tr>
                    <tr>
                        <td>Vivo por el rock 6</td>  
                        <td>Contara con artistas nacionales e internacionales, Arctic monkeys, red hot, cold play y tourista</td>  
                        <td>Concierto</td>  
                        <td>Limapalooza producciones</td> 
                        <td>
                            <a class="btn btn-info" title="Pagar"><i class="fa fa-usd"></i></i></a>
                        </td> 
                    </tr>
                    <tr>
                        <td>Vivo por el rock 7</td>  
                        <td>Contara con artistas nacionales e internacionales,<br> Arctic monkeys, red hot, cold play y tourista</td>  
                        <td>Concierto</td>  
                        <td>Limapalooza producciones</td>
                        <td>
                            <a class="btn btn-info" title="Pagar"><i class="fa fa-usd"></i></i></a>
                        </td> 
                    </tr>
                </table>                
                <legend>Datos organizador:</legend>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Nombre</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputEmail3" placeholder="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Ruc</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputEmail3" placeholder="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Número de cuenta</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputEmail3" placeholder="">
                    </div>
                </div>      
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Fecha entrega</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control">
                    </div>
                </div> 
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Monto de pago</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputEmail3" placeholder="">
                    </div>
                </div>    
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Evento</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputEmail3" placeholder="">
                    </div>
                </div>  
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <a  class="btn btn-info" href="#" >Registrar pago</a>
                  <button  type="reset" class="btn btn-info">Cancelar</button>
                </div>
              </div>                                                                                             
            </form>
          </div>
        </div>    
        <!-- /.row -->  


@stop

@section('javascript')
	{!!Html::script('js/moment.js')!!}
	{!!Html::script('js/rangepicker.js')!!}
@stop