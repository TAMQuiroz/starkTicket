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
							<th>Nombre Promoción</th>
							<th>Nombre del evento</th>

							<th>Usuario creador</th>
							<th>Fecha de Finalizacion</th>

							<th>Ver</th>
							<th>Editar</th>
							<th>Eliminar</th>
						</tr>
					</thead>
					<tbody>
						@foreach($promotions as $promotion)
						<tr>
							<td>{{$promotion->name}}</td>

							<td>{{$events[($promotion->event_id)-1]['name']}}</td>



							<td>{{$users[($promotion->user_id)-1]['name']}}</td>

							<td>{{$promotion->endday}}</td>


							<td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#info{{$promotion->id}}" data-whatever="@mdo"><i class="glyphicon glyphicon-plus"></i></button></td>





							<div class="modal fade" id="info{{$promotion->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title" id="exampleModalLabel">Detalle de Promoción</h4>
										</div>
										<div class="modal-body">
											<form>
												<div class="form-group">
													<h3>{{$promotion->name}}</h3>
													<p>Código = {{$promotion->id}} </p>
													<p>Creada por el usuario =  {{$users[($promotion->user_id)-1]['name']}}    </p>
													<p>FECHA INICIO {{$promotion->startday}}    </p>
													<p>FECHA FIN {{$promotion->endday}} horas   </p>

													@if($promotion->typePromotion == 1 )
													<p> Promoción de descuento del  {{$promotion->desc}}%  </p>
													<p> Válido para  </p>	<ul>
													<li> {{$accessPromotions[($promotion->access_id)-1]['description'] }}

													</li>

												</ul>
												@else
												<p> OFERTA   {{$promotion->carry}} x {{$promotion->pay}}  </p>
												<p>  Lleva  {{$promotion->carry}} y paga   {{$promotion->pay}} </p>
												<p>   Valido únicamente para la zona     </p>
												<ul>
													<li>{{$zones[($promotion->zone_id)-1]['name'] }}   </li>



												</ul>
												@endif




											</div>
										</form>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
									</div>
								</div>
							</div>
						</div>

						<td><a href="{{url('promoter/promotion/'.$promotion->id.'/edit')}}"><button class="btn btn-info"><i class="glyphicon glyphicon-pencil"></i></button></a></td>
						<td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#remove{{$promotion->id}}" data-whatever="@mdo"><i class="glyphicon glyphicon-remove"></i></button></td>

						<div class="modal fade" id="remove{{$promotion->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
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
												<a class="btn btn-info" href="{{url('promoter/promotion/'.$promotion->id.'/delete')}}" title="Delete" >Sí</a>
												<button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>

					</tr>

					@endforeach

				</tbody>

			</table>
		</div>

	</div>




</div>
</div>
@stop

@section('javascript')

@stop