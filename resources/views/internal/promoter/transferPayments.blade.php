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
                    <label  class="col-sm-2 control-label">Nombre evento</label>
                    <div class="col-sm-10">
                      {!! Form::text('eventName','', array('class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Categoría</label>
                    <div class="col-sm-10">
                        {!! Form::select('category', ['Concierto','Teatro','Ferias y Circo','Otros'],null,['class' => 'form-control']) !!}
                    </div>      
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Organizador</label>
                    <div class="col-sm-10">
                        {!! Form::select('organizer', ['Pepitos Producciones','Rayo en la botella','Hermanos yaipen'],null,['class' => 'form-control']) !!}
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
                    <label  class="col-sm-2 control-label">Nombre</label>
                    <div class="col-sm-10">
                      {!! Form::text('organizerName','Limapalooza producciones', array('class' => 'form-control','disabled')) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-2 control-label">Ruc</label>
                    <div class="col-sm-10">
                      {!! Form::text('ruc','2566444998', array('class' => 'form-control','disabled')) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-sm-2 control-label">Número de cuenta</label>
                    <div class="col-sm-10">
                      {!! Form::text('countNumber','223333398', array('class' => 'form-control','disabled')) !!}
                    </div>
                </div>      
                <div class="form-group">
                    <label  class="col-sm-2 control-label">Fecha entrega</label>
                    <div class="col-sm-10">
                        {!! Form::date('dateSend','', array('class' => 'form-control')) !!}
                    </div>
                </div> 
                <div class="form-group">
                    <label  class="col-sm-2 control-label">Monto de deuda</label>
                    <div class="col-sm-10">
                    {!! Form::text('totalMont','100000', array('class' => 'form-control','disabled')) !!}
                    </div>
                </div>   
                <div class="form-group">
                    <label class="col-sm-2 control-label">Monto a pagar</label>
                    <div class="col-sm-10">
                      {!! Form::text('payMont','100000', array('class' => 'form-control')) !!}
                    </div>
                </div>       
                <div class="form-group">
                    <label  class="col-sm-2 control-label">Saldo</label>
                    <div class="col-sm-10">
                      {!! Form::text('saldo','50000', array('class' => 'form-control','disabled')) !!}
                    </div>
                </div>                           
                <div class="form-group">
                    <label  class="col-sm-2 control-label">Evento</label>
                    <div class="col-sm-10">
                      {!! Form::text('eventNameSearch','Vivo por el rock 7', array('class' => 'form-control','disabled')) !!}
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