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
					<input type="text"></input>
					<button type="button" class="btn btn-info">Buscar</button>
					<br><br>
					<div class="table-responsive">
					  <table class="table table-hover">
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
					            <input type="text" class="form-control" id="recipient-name">
					          </div>
					          <div class="form-group">
					            <label for="recipient-name" class="control-label">Fecha Fin:</label>
					            <input type="text" class="form-control" id="recipient-name">
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
					          <input type="text"></input>
								<button type="button" class="btn btn-info">Buscar</button>
								<br><br>
					          <div class="table-responsive">
								  <table class="table">
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
								<h4>Agregar categorías:</h4>
								<input type="text"></input>
								<button type="button" class="btn btn-info">Buscar</button>
								<br><br>
								<div class="table-responsive">
								  <table class="table">
								    <thead>
								        <tr>
								            <th>Tipo</th>
								            <th>Eliminar</th>
								        </tr>
								    </thead>
								    <tbody>
								        <tr>
								            <td>Conciertos</td>
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
								Válida del 01/08/2015 al 13/10/2015.</p>
								<h5>Aplica para los siguientes eventos:</h5>
								<ul>
									<li>Viva por el Rock 6</li>
									<li>Arctic Monkeys Lima 2020</li>
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
						Código: <input type="text"></input>
						Nombre: <input type="text"></input>
						<br><br>
						Fecha Inicio: <input type="text"></input>
						Fecha Fin: <input type="text"></input>
						<br><br>
						Descripcion: <input type="text"></input>
						Descuento (%): <input type="text"></input>
						<br><br>
						<h4>Agregar eventos:</h4>
						<input type="text"></input>
						<button type="button" class="btn btn-info">Buscar</button>
						<br><br>
						<div class="table-responsive">
						  <table class="table">
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
						<br><br>
						<h4>Agregar categorías:</h4>
						<input type="text"></input>
						<button type="button" class="btn btn-info">Buscar</button>
						<br><br>
						<div class="table-responsive">
						  <table class="table">
						    <thead>
						        <tr>
						            <th>Tipo</th>
						            <th>Eliminar</th>
						        </tr>
						    </thead>
						    <tbody>
						        <tr>
						            <td>Conciertos</td>
						            <td><button type="button" class="btn btn-info">x</button></td>
						        </tr>
						    </tbody>
						  </table>
						</div>
						<br><br>
						<button type="button" class="btn btn-info">Guardar</button>
						<button type="button" class="btn btn-info">Cancelar</button>

					</div>
				</div>
			</div>
		</div>
@stop

@section('javascript')

@stop