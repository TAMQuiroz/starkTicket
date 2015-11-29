@extends('layout.client')

@section('style')
	{!!Html::style('css/images.css')!!}
@stop

@section('title')
	Eventos Recomendados
@stop

@section('content')
<div class="row">
    <?php $i = 0; ?>
	@foreach($clientPreferences as $clientPreference)
  	<div class="col-sm-3">
        {!! Html::image($clientPreference->image,  null, array('class'=>'image cat_img')) !!}
        <h3>{{$clientPreference->name}}</h3>
        <p>
            <b>Fecha de venta: </b> {{date('Y-m-d',$clientPreference->selling_date)}}<br>
            <b>Lugar: </b> {{$clientPreference->place->name}} <br>
            <b>Direccion:</b> {{$clientPreference->place->address}} <br>
        </p>
        <p><a href="{{url('event/'.$clientPreference->id.'')}}" class="btn btn-info" role="button">Detalle</a></p>
    </div>
    <?php
        $i++;
        $mod = $i % 4;
     ?>
     @if ($mod==0)
     </div>
     <div class="row">
     @endif
  	@endforeach
</div>
@stop
@section('javascript')

@stop











