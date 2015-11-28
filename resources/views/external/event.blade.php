@extends('layoutExternal')

@section('style')
<style>
	#map {
		width: 400px;
		height: 400px;
	}
</style>
{!!Html::style('css/images.css')!!}
@stop

@section('title')
{{$event->name}}
@stop

@section('content')
@if (Session::has('bookingmailmessage'))
<div class="alert alert-info">{{ Session::get('bookingmailmessage') }}</div>
@endif
<!-- Main -->
<div id="main">
	<div class="row">
		<!-- Content -->
		<div class="col-md-8">
			{!!Form::open(array('url' => 'event/'.$event->id.'/' ,'id'=>'form','class'=>'form-horizontal'))!!}
			<section>
				<p><a  class="image full">{!! Html::image($event->image, null,['class'=>'carousel_img']) !!}</a></p>
				<p>{{ $event->description }}</p>
				<br>
				<div class="table-responsive">
					<table class="table table-bordered" style="widht:1px">
						<thead>
							<tr>
								<th>Zona</th>
								<th>Precio</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($event->zones as $zone)
							<tr>
								<td>{{$zone->name}}</td>
								<td>S/. {{$zone->price}}</td>
							</tr>
							@endforeach

						</tbody>
					</table>
				</div>
				@if(isset($user) && $user->role_id == config('constants.salesman'))
					@if($event->selling_date <= strtotime(Carbon\Carbon::now()) )
						@if (count($event->presentations) > 0 )
							<a href="{{url('salesman/event/'.$event->id.'/buy')}}"><button type="button" class="btn btn-info">Comprar Entrada</button></a>
						@endif
					@endif
				@else
					@if($event->selling_date <= strtotime(Carbon\Carbon::now()) )
						@if (count($event->presentations) > 0 )
							<a href="{{url('client/event/'.$event->id.'/buy')}}"><button type="button" class="btn btn-info">Comprar Entrada</button></a>
							<a href="{{url('client/'.$event->id.'/reservanueva')}}"><button type="button" class="btn btn-info">Reservar Entrada</button></a>
						@endif
					@endif
				@endif

				<br>

				@if(isset($user) && $user->role_id == config('constants.client'))
				<br><br>
					<div class="form-group">
						<label for="comment">Ingrese comentario:</label>
						{!! Form::textarea('comment', null, ['class' => 'form-control', 'rows' => '5']) !!}
						<button type="submit" class="btn btn-info">Aceptar</button>
						<br>
					</div>
				@endif
				<div class="form-group">
					<br>
					<label for="comment">Comentarios:</label>
					@foreach ($Comments as $Comment)
						<br>
						<h6>{{$Comment->user->name}} {{$Comment->user->lastname}} {{ date ( "d-m-Y H:ia" , strtotime( $Comment->time )) }}</h6>
						<p>{!! Form::textarea('pastComment1', null, ['class' => 'form-control', 'rows' => '3', 'placeholder'=> $Comment->description, 'readonly']) !!}</p>
						@if(isset($user) && $user->role_id == config('constants.admin'))
							<a class="btn btn-info" style="float:right" data-toggle="modal" data-target="#deleteModal{{$Comment->id}}">Eliminar</a>
							<div class="modal fade"  id="deleteModal{{$Comment->id}}">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title">¿Estas seguro que desea eliminar el comentario?</h4>
										</div>
										<div class="modal-body">
											<h5 class="modal-title">Los cambios serán permanentes</h5>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-info" data-dismiss="modal">No</button>
											<a class="btn btn-info" href="{{url('event/delete/'.$Comment->id.'/comment')}}" title="Delete" >Sí</a>
										</div>
									</div><!-- /.modal-content -->
								</div><!-- /.modal-dialog -->
							</div><!-- /.modal -->
						@endif
					@endforeach
				</div>
				
			</section>
		</div>
		<!-- /Content -->

		<!-- Sidebar -->
		<div class="col-md-4">
			<section>
				@if ($event->cancelled)
				<div class="alert alert-danger">Evento cancelado</div>
				@endif
				<header>
					<h2 class="detail">Detalle de evento</h2>
				</header>
				@if (count($event->presentations) < 1 )
				<div class="alert alert-info">No se han econtrado fechas de presentación</div>
				@else
				<h3 class="dates">Fechas del evento</h3>
				<p>Del {{date("d/m/Y", $event->presentations->first()->starts_at)}} Al {{date("d/m/Y", $event->presentations->last()->starts_at)}}</p>
				<h3 class="dates">Horario</h3>
				<p>Función a las {{date("H:i", $event->presentations->first()->starts_at)}}</p>
				@endif
				<h3 class="dates">Ubicación</h3>
				<p>{{$event->place->address}}, {{$event->place->district}}</p>
				{!! Html::image($event->place->image,null, ['class'=>'carousel_img']) !!}
				<h3>Categoria</h3>
				{{$event->category->name}}
				<h3 class="dates">Distribución de Zonas</h3>
				<p>{!! Html::image($event->distribution_image,null, ['class'=>'carousel_img']) !!}</p>
			</section>
		</div>
		<!-- Sidebar -->

	</div>
</section>
</div>
<!-- /Content -->
</div>
</div>
<!-- Main -->

@stop

@section('javascript')

@stop