@extends('layout.client')

@section('style')
	{!!Html::style('css/images.css')!!}
@stop

@section('title')
	Bienvenido cliente
@stop

@section('content')

<div><h4>Eventos Recomendados</h4></div>

<div class="row">
  	<div class="col-sm-6 col-md-4">
	    <div class="thumbnail">
	      {!! Html::image('images/pics13.jpg', null, array('class'=>'image')) !!}
	      <div class="caption">
	        <h3>Evento 1</h3>
	        <p>Descripcion de evento 1</p>
	        <p><a href="{{url('event/1')}}" class="btn btn-primary" role="button">Detalle</a></p>
	      </div>
	    </div>
  	</div>
  	<div class="col-sm-6 col-md-4">
	    <div class="thumbnail">
	      {!! Html::image('images/pics13.jpg', null, array('class'=>'image')) !!}
	      <div class="caption">
	        <h3>Evento 1</h3>
	        <p>Descripcion de evento 1</p>
	        <p><a href="#" class="btn btn-primary" role="button">Detalle</a></p>
	      </div>
	    </div>
  	</div>
  	<div class="col-sm-6 col-md-4">
	    <div class="thumbnail">
	      {!! Html::image('images/pics13.jpg', null, array('class'=>'image')) !!}
	      <div class="caption">
	        <h3>Evento 1</h3>
	        <p>Descripcion de evento 1</p>
	        <p><a href="#" class="btn btn-primary" role="button">Detalle</a></p>
	      </div>
	    </div>
  	</div>
</div>
@stop

@section('javascript')

@stop