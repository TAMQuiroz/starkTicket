@extends('layoutExternal')

@section('style')
	{!!Html::style('css/skeletoGift.css')!!}
	{!!Html::style('css/estiloGift.css')!!}
	{!!Html::style('css/images.css')!!}
	<style type="text/css">
		#nav .seventh{
            color: white;
        }
    </style>    
@stop

@section('title')
	Canjeo de Regalos
@stop

@section('content')
	<header>
		<h3>Canjea tu Premio </h3>

	</header>
	@if (count($gifts)>0)
		<div class="row">
			@foreach($gifts as $gift)
			<div class="4u">
				<section style="text-align:center">
					<font size="6">{{$gift->points}} Puntos</font>
					<a href="#" class="image full">
						{!! Html::image($gift->image, null, array('class'=>'gift-external')) !!}
						{{$gift->name}}
					</a>
				</section>
			</div>
			@endforeach
		</div>
	@else
        <div class="alert alert-danger">No hay Regalos Disponibles</div>
    @endif
@stop

@section('javascript')

@stop