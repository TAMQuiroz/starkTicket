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
					            <th>Fecha y hora fin</th>
					          
					            <th>Ver</th>
					            <th>Editar</th>
					            <th>Eliminar</th>
					        </tr>
					    </thead>
					    <tbody>
 							@foreach($promotions as $promotion)
					        <tr>
					            <td>{{$promotion->name}}</td>
					            <td>Promotor</td>
					            <td>{{$promotion->endday}}</td>
					            
					            <td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#info" data-whatever="@mdo"><i class="glyphicon glyphicon-plus"></i></button></td>
					            <td><a href="{{url('promoter/promotion/1/edit')}}"><button class="btn btn-info"><i class="glyphicon glyphicon-pencil"></i></button></a></td>
					            <td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#remove" data-whatever="@mdo"><i class="glyphicon glyphicon-remove"></i></button></td>
					        </tr>
					   
					          @endforeach


					    </tbody>



					  </table>
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
								<h5>Aplica para el evento evento:</h5>
								<ul>
									<li>Viva por el Rock 6 - Zona VIP</li>
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




				</div>


				  

			</div>
		</div>
@stop

@section('javascript')

@stop