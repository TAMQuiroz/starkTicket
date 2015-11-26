@extends('layout.client')

@section('style')
	{!!Html::style('css/images.css')!!}
	<style type="text/css">
		.btn-primary{
            background-color: #83D3C9;
            border-color: #83D3C9;
        }
        .btn-primary:hover{
            background-color: #329DB7;
            border-color: #329DB7;
        }
        .row h3, .row p{
        	text-align: center;
        }
        section .caption{
        	float:left;
        }

        .caption h3, .caption p{
        	text-align: left;
        }

	</style>
@stop

@section('title')
	Bienvenido {{$client->name}}
@stop

@section('content')

<div><h4>Eventos Recomendados</h4></div>

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
	        <p><a href="{{url('event/'.$clientPreference->id.'')}}" class="btn btn-primary" role="button">Detalle</a></p>'
		   </div>
	      </section>
	    </div>
  	</div>
  	@endforeach


</div>
@stop


@section('javascript')

@stop











