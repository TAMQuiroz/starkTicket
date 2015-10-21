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
		<h1>Canjea tu Premio </h1>

	</header>
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
@stop

@section('javascript')

@stop