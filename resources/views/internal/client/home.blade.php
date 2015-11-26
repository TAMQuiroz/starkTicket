@extends('layout.client')

@section('style')
	{!!Html::style('css/images.css')!!}
@stop

@section('title')
	Bienvenido {{$client->name}}
@stop

@section('content')
<h4>Eventos Recomendados</h4>
<div class="row">
	@foreach($clientPreferences as $clientPreference)
  	<div class="col-sm-6 col-md-4">
	    <div >
	       <section>

	      {!! Html::image($clientPreference->image,  null, array('class'=>'image cat_img')) !!}
	      <div class="caption">
	        <h3>{{$clientPreference->name}}</h3>

	        <p>
	        	<!--<b>{{$clientPreference->description}}</b>-->
	        	<b>Fecha de venta: </b> {{date('Y-m-d',$clientPreference->selling_date)}}<br>
                <b>Lugar: </b> {{$clientPreference->place->name}} <br>
                <b>Direccion:</b> {{$clientPreference->place->address}} <br>
	        </p>
	        <p><a href="{{url('event/'.$clientPreference->id.'')}}" class="btn btn-info" role="button">Detalle</a></p>
		   </div>
	      </section>
	    </div>
  	</div>
  	@endforeach
</div>
@stop
@section('javascript')

@stop











