@extends('layoutExternal')

@section('style')
    <style type="text/css">
    #nav .fourth{
            color: white;
        }
    </style>
@stop

@section('title')
	Acerca de Nosotros
@stop

@section('content')
    
    {!! Html::image($about->image, null, array('class'=>'image center-block img-thumbnail')) !!}
    <div class="col-md-12">
	   <h1>Nosotros</h1>
        <p>{{$about->description}}</p>
    </div>
    <div class="col-md-12">
        <h2>Misión</h2>
        <p>{{$about->mision}}</p>
    </div>
    <div class="col-md-12">
        <h2>Visión</h2>
        <p>{{$about->vision}}</p>
    </div>
    <div class="col-md-12">
        <h2>Historia</h2>
        <p>{{$about->history}}</p>
    </div>

    <iframe width="560" height="315" class="center-block" src="{{$about->youtube_url}}" frameborder="0" allowfullscreen></iframe>
@stop

@section('javascript')

@stop