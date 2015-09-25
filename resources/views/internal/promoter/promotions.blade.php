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
					
			    	<div class="input-group" style="width:300px">
			      		<input type="text" class="form-control" placeholder="Buscar promoción..." >
			      		<span class="input-group-btn">
					    	<button class="btn btn-info" type="button">Buscar</button>
					    </span>
			    	</div><!-- /input-group -->
				    
				    <br><br>
					<div class="table-responsive">
					  <table class="table table-bordered table-striped">
					    <thead>
					        <tr>
					            <th>Nombre</th>
					            <th>Cantidad Eventos</th>
					            <th>Fecha Fin</th>
					            <th>Ver</th>
					            <th>Editar</th>
					            <th>Eliminar</th>
					        </tr>
					    </thead>
					    <tbody>
					        <tr>
					            <td>Promoción Visa Platinium</td>
					            <td>13</td>
					            <td>13/10/2015</td>
					            <td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#info" data-whatever="@mdo"><i class="glyphicon glyphicon-plus"></i></button></td>
					            <td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#edit" data-whatever="@mdo"><i class="glyphicon glyphicon-pencil"></i></button></td>
					            <td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#remove" data-whatever="@mdo"><i class="glyphicon glyphicon-remove"></i></button></td>
					        </tr>
					        <tr>
					            <td>Promoción Mastercard</td>
					            <td>10</td>
					            <td>20/12/2015</td>
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
					            <input type="text" class="form-control" id="recipient-name" value="Promoción Visa Platinium">
					          </div>
					          <div class="form-group">
					            <label for="recipient-name" class="control-label">Fecha Fin:</label>
					            <input type="date" class="form-control" id="recipient-name" value="13/10/2015">
					          </div>
					          <div class="form-group">
					            <label for="recipient-name" class="control-label">Hora Fin:</label>
					            <input type="datetime" class="form-control" id="recipient-name" value="24:00">
					          </div>
					          <div class="form-group">
					            <label for="recipient-name" class="control-label">Descripción:</label>
					            <input type="text" class="form-control" id="recipient-name">
					          </div>
					          <div class="form-group">
					            <label for="recipient-name" class="control-label">Descuento (%):</label>
					            <input type="text" class="form-control" id="recipient-name">
					          </div>
					          <h4 class="modal-title" id="exampleModalLabel">Agregar eventos:</h4>
							  <div class="input-group" style="width:300px">
					      		<input type="text" class="form-control" placeholder="Buscar eventos..." >
					      		<span class="input-group-btn">
							    	<button class="btn btn-info" type="button">Buscar</button>
							    </span>
					    	 </div><!-- /input-group -->
					    	 <br>
					          <div class="table-responsive">
								  <table class="table table-bordered">
								    <thead>
								        <tr>
								            <th>Nombre</th>
								            <th>Eliminar</th>
								        </tr>
								    </thead>
								    <tbody>
								        <tr>
								            <td>Viva por el Rock 6</td>
								            <td><button type="button" class="btn btn-info">x</button></td>
								        </tr>
								        <tr>
								            <td>Arctic Monkeys Lima 2020</td>
								            <td><button type="button" class="btn btn-info">x</button></td>
								        </tr>
								    </tbody>
								  </table>
								</div>
					        </form>
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-info">Guardar</button>
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
								<p>Código CA21231J.
								Válida del 01/08/2015 a las 00:00 hasta el 13/10/2015 a las 24:00.</p>
								<p>Promoción exclusiva con tarjetas Visa Platinium</p>
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

					<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo1">Agregar Promoción</button>
					<div id="demo1" class="collapse">
						<br>
						<h4>Ingrese datos de nueva promoción</h4>
						<label>
							Código: <input type="text" class="form-control" placeholder="9898083" readonly></input>
							Nombre: <input type="text" class="form-control" placeholder="Nombre de evento"></input>
							Fecha Inicio: <input type="date" class="form-control"></input>
							Fecha Fin: <input type="date" class="form-control"></input>
							Hora Inicio: <input type="datetime" class="form-control" placeholder="hh:mm"></input>
							Hora Fin: <input type="datetime" class="form-control" placeholder="hh:mm"></input>
							Descripcion: <input type="text" class="form-control" placeholder="Descripción de evento..."></input>
							Descuento (%): <input type="text" class="form-control" placeholder="%..."></input>
						</label>
						
						<br><br>
						<h4>Agregar eventos:</h4>
						<div class="input-group" style="width:300px">
				      		<input type="text" class="form-control" placeholder="Buscar eventos..." >
				      		<span class="input-group-btn">
						    	<button class="btn btn-info" type="button">Buscar</button>
						    </span>
				    	</div><!-- /input-group -->
				    	<br>
				    	<h5>Seleccionar Zona:</h5>
				        <select class="form-control" style="width:260px">
		                    <option value="">VIP</option>
		                    <option value="saab">Campo</option>
		                    <option value="mercedes">Occidente</option>
		                </select>
						<br>
						<button class="btn btn-info" type="button">Agregar Zona y Promoción</button>
						<br><br>
						<div class="table-responsive">
						  <table class="table table-bordered table-striped">
						    <thead>
						        <tr>
						            <th>Nombre</th>
						            <th>Zona</th>
						            <th>Eliminar</th>
						        </tr>
						    </thead>
						    <tbody>
						        <tr>
						            <td>Viva por el Rock 6</td>
						            <td>VIP</td>
						            <td><button type="button" class="btn btn-info">x</button></td>
						        </tr>
						        <tr>
						            <td>Arctic Monkeys Lima 2020</td>
						            <td>VIP</td>
						            <td><button type="button" class="btn btn-info">x</button></td>
						        </tr>
						    </tbody>
						  </table>
						</div>
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