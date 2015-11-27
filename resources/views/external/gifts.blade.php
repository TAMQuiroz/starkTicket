@extends('layoutExternal')

@section('style')
	{!!Html::style('css/images.css')!!}
@stop

@section('title')
	Canjeo de Regalos
@stop

@section('content')
	<h3>Canjea tu Premio </h3>
	@if (count($gifts)>0)
		<div class="row">
			@foreach($gifts as $gift)
			<div class="col-md-4">
				<div class="text-center">
					<font size="6">{{$gift->points}} Puntos</font>
					<div>{!! Html::image($gift->image, null, array('class'=>'gift-external img-thumbnail')) !!}</div>
					<p>{{$gift->name}}</p>
					<hr>
				</div>
			</div>
			@endforeach
		</div>
	@else
        <div class="alert alert-danger">No hay Regalos Disponibles</div>
    @endif
@stop

@section('javascript')

@stop