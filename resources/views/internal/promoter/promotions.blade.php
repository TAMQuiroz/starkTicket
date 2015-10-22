@extends('layout.promoter')

@section('style')

@stop

@section('title')
	Promociones
@stop

@section('content')
        <!-- Content Row -->
        <div class="row">
            <!-- Content Column -->
            <div class="col-md-9">
				<div class="container">  <!-- Comienza primer despliegue-->
									    
				    <br><br>
					<div class="table-responsive">
					  <table class="table table-bordered table-striped">
					    <thead>
					        <tr>
					            <th>Nombre</th>
					            <th>Usuario creador</th>
					            <th>Fecha Fin</th>
					            <th>Hora Fin</th>
					            <th>Ver</th>
					            <th>Editar</th>
					            <th>Eliminar</th>
					        </tr>
					    </thead>
					    <tbody>
					        <tr>
					            <td>Promoción Visa Platinium</td>
					            <td>Samoel Sarmiento</td>
					            <td>13/10/2015</td>
					            <td>24:00</td>
					            <td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#info" data-whatever="@mdo"><i class="glyphicon glyphicon-plus"></i></button></td>
					            <td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#edit" data-whatever="@mdo"><i class="glyphicon glyphicon-pencil"></i></button></td>
					            <td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#remove" data-whatever="@mdo"><i class="glyphicon glyphicon-remove"></i></button></td>
					        </tr>
					        <tr>
					            <td>Promoción Mastercard</td>
					            <td>Samoel Sarmiento</td>
					            <td>20/12/2015</td>
					            <td>20:00</td>
					            <td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo"><i class="glyphicon glyphicon-plus"></i></button></td>
					            <td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo"><i class="glyphicon glyphicon-pencil"></i></button></td>
					            <td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo"><i class="glyphicon glyphicon-remove"></i></button></td>
					        </tr>
					    </tbody>
					  </table>
					</div>
					<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
					  <div class="modal-dialog" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					        <h4 class="modal-title" id="exampleModalLabel">Modificar Promoción</h4>
					      </div>
					      <div class="modal-body">
					        <form>
								
					          <div class="form-group">
					            <label for="recipient-name" class="control-label">Nombre:</label>
					            {!! Form::text('editName','Promoción Visa Platinium', array('class' => 'form-control','required')) !!}
					          </div>
					          <div class="form-group">
					            <label for="recipient-name" class="control-label">Fecha Fin:</label>
					            {!! Form::date('editDate','13/10/2015', array('class' => 'form-control','required')) !!}
					          </div>
					          <div class="form-group">
					            <label for="recipient-name" class="control-label">Hora Fin:</label>
					            {!! Form::time('editTime','24:00', array('class' => 'form-control','required')) !!}
					          </div>
					          <div class="form-group">
					            <label for="recipient-name" class="control-label">Descripción:</label>
					            {!! Form::textarea('editDescription', null, ['size' => '30x3', 'class' => 'form-control', 'required']) !!}
					          </div>
					          <div class="form-group">
					            <label for="recipient-name" class="control-label">Descuento (%):</label>
					            {!! Form::text('editDiscount','%', array('class' => 'form-control','required')) !!}
					          </div>
					          <h4 class="modal-title" id="exampleModalLabel">Agregar eventos:</h4>
							  <div class="input-group" style="width:300px">
					      		<input type="text" class="form-control" placeholder="Buscar eventos..." >
					      		<span class="input-group-btn">
							    	<button class="btn btn-info" type="button">Buscar</button>
							    </span>
					    	  </div><!-- /input-group -->
					    	 <br>
					    		<table class="table table-bordered table-striped">
								    <tr>
								        <th>Nombre</th>
								        <th>Categoría</th>
								        <th>Seleccionar</th>
								    </tr>
								    <tr>
								    	<td>Viva por el rock 6</td>
								    	<td>Concierto</td>
								    	<td><input type="radio" name="group2"></td>	
								    </tr>
								    <tr>
								    	<td>Viva la Fête</td>
								    	<td>Concierto</td>
								    	<td><input type="radio" name="group2"></td>
								    </tr>
								</table>
								<div style="-webkit-columns: 100px 2;">
									<label for="recipient-name" class="control-label">Zona:</label>
									{!! Form::select('zone', ['VIP','Platea'],null,['class' => 'form-control','required']) !!}
									<label for="recipient-name" class="control-label">Tipo de Cliente:</label>
									{!! Form::select('zone', ['Niño','Adulto', 'Adulto Mayor'],null,['class' => 'form-control','required']) !!}
								</div>	    
					        </form>
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-info" data-dismiss="modal">Guardar</button>
					        <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
					      </div>
					    </div>
					  </div>
					</div>

					<div class="modal fade" id="info" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
					  <div class="modal-dialog" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					        <h4 class="modal-title" id="exampleModalLabel">Detalle de Promoción</h4>
					      </div>
					      <div class="modal-body">
					        <form>
					          <div class="form-group">
				            	<h4>Promoción Visa Platinium</h4>
								<p>Código CA21231J. Creada por Samoel Sarmiento</p>
								<p>Válida del 01/08/2015 a las 00:00 hasta el 13/10/2015 a las 24:00.</p>
								<p>%30 de descuento: Promoción exclusiva con tarjetas Visa Platinium.</p>
								<h5>Aplica para los siguientes eventos:</h5>
								<ul>
									<li>Viva por el Rock 6 - Zona VIP</li>
									<li>Arctic Monkeys Lima 2020 - Zona VIP</li>
								</ul>
								<br><br>
								<h4>Información de Ventas</h4>
								<p>Cantidad de Clientes que accedieron: 249</p>
								<p>Evento más accedido: Arctic Monkeys Lima 2020</p>
					          </div>
					        </form>
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
					      </div>
					    </div>
					  </div>
					</div>

					<div class="modal fade" id="remove" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
					  <div class="modal-dialog" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					        <h4 class="modal-title" id="exampleModalLabel">Eliminar</h4>
					      </div>
					      <div class="modal-body">
					        <form>
					        	<div class="form-group">
						            <label for="recipient-name" class="control-label">¿Está seguro que desea continuar?</label>
						            <br><br>
						            <button type="button" class="btn btn-info" data-dismiss="modal">Continuar</button>
						            <button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button>
						        </div>
					        </form>
					      </div>
					    </div>
					  </div>
					</div>

					<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo1">Agregar Promoción</button>
					<div id="demo1" class="collapse">

						<br>
						<legend>Ingrese datos de nueva promoción</legend>
							<div style="-webkit-columns: 100px 3;">
								<h4>Código</h4>
								{!! Form::text('codePromotion','9898083', array('class' => 'form-control','required','disabled')) !!}
								<h4>Nombre</h4>
								{!! Form::text('promotionName','', array('class' => 'form-control','required')) !!}	
								<h4>Descuento (%)</h4>
								{!! Form::text('discount','%', array('class' => 'form-control','required')) !!}
							</div>
							<div style="-webkit-columns: 100px 4;">
								<h4>Fecha Inicio</h4>
								{!! Form::date('dateIni','', array('class' => 'form-control','required')) !!}
								<h4>Fecha Fin</h4>
								{!! Form::date('dateEnd','', array('class' => 'form-control','required')) !!}
								<h4>Hora Inicio</h4>
								{!! Form::time('timeIni','', array('class' => 'form-control','required')) !!}
								<h4>Hora Fin</h4>
								{!! Form::time('timeEnd','', array('class' => 'form-control','required')) !!}
							</div>
							<h4>Descripción</h4>
							{!! Form::textarea('description', null, ['size' => '30x3', 'class' => 'form-control', 'required']) !!}
							
							<h4>Agregar eventos:</h4>
							<div class="input-group" style="width:300px">
					      		{!! Form::text('eventName','', array('class' => 'form-control','required')) !!}
					      		<span class="input-group-btn">
							    	<button class="btn btn-info" type="button">Buscar</button>
							    </span>
					    	</div><!-- /input-group -->
					    	<br>
					    	<table class="table table-bordered table-striped">
							    <tr>
							        <th>Nombre</th>
							        <th>Categoría</th>
							        <th>Seleccionar</th>
							    </tr>
							    <tr>
							    	<td>Viva por el rock 6</td>
							    	<td>Concierto</td>
							    	<td><input type="radio" name="group1"></td>	
							    </tr>
							    <tr>
							    	<td>Viva la Fête</td>
							    	<td>Concierto</td>
							    	<td><input type="radio" name="group1"></td>
							    </tr>
							</table>    
							<div style="-webkit-columns: 100px 2;">
								<h4>Zona</h4>
								{!! Form::select('zone', ['VIP','Platea'],null,['class' => 'form-control','required']) !!}
								<h4>Tipo de Cliente</h4>
								{!! Form::select('zone', ['Niño','Adulto', 'Adulto Mayor'],null,['class' => 'form-control','required']) !!}
							</div>
						<br><br>
						

				    	
						<button type="button" class="btn btn-info" data-toggle="modal" data-target="#end" data-whatever="@mdo">Guardar</button>
						<button type="button" class="btn btn-info">Cancelar</button>
						<div class="modal fade" id="end" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                		<div class="modal-dialog" role="document">
		                    <div class="modal-content">
		                      <div class="modal-header">
		                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		                        <h4 class="modal-title" id="exampleModalLabel">Promociones</h4>
		                    </div>
		                    <div class="modal-body">
		                        <form>
		                          <div class="form-group">
		                              <div class="form-group">
		                                <label for="exampleInputEmail2">Promoción agregada!</label>
		                          </div>
		                        </form>
		                    </div>
		                    </div>
		                  </div>
		                </div> 
					</div>
				</div>
			</div>
		</div>
@stop

@section('javascript')

@stop