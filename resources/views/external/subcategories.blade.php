@extends('layoutExternal')

@section('style')
	{!!Html::style('css/images.css')!!}
	<style type="text/css">
        #nav .second{
            color: white;
        }
        .btn-primary{
            background-color: #83D3C9;
            border-color: #83D3C9;
            margin-left: 90px;
        }
        .btn-primary:hover{
            background-color: #329DB7;
            border-color: #329DB7;
        }
        .row h3{
            text-align: center;
        }
        .row .image{
            margin-left: 30px;
        }
    </style>
@stop

@section('title')
	Subcategorias
@stop

@section('content')
	<legend>Categoria 1</legend>	
	<div class="row">
        <div class="col-sm-3">
            {!! Html::image('images/pics13.jpg', null, array('class'=>'image cat_img')) !!}
            <h3>Subcategoria 1</h3>
            <p><a href="{{url('event')}}" class="btn btn-primary" role="button" data-target="#info" data-whatever="@mdo">Ver más</a></p>
        </div>
        <div class="col-sm-3">
            {!! Html::image('images/pics13.jpg', null, array('class'=>'image cat_img')) !!}
            <h3>Subcategoria 2</h3>
            <p><a href="{{url('event')}}" class="btn btn-primary" role="button"  data-target="#info" data-whatever="@mdo">Ver más</a></p>
        </div>
        <div class="col-sm-3">
            {!! Html::image('images/pics13.jpg', null, array('class'=>'image cat_img')) !!}
            <h3>Subcategoria 3</h3>
            <p><a href="{{url('event')}}" class="btn btn-primary" role="button"  data-target="#info" data-whatever="@mdo">Ver más</a> </p>
        </div>
        <div class="col-sm-3">
            {!! Html::image('images/pics13.jpg', null, array('class'=>'image cat_img')) !!}
            <h3>Categoria 4</h3>
            <p><a href="{{url('cevent')}}" class="btn btn-primary" role="button"  data-target="#info" data-whatever="@mdo">Ver más</a></p>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            {!! Html::image('images/pics13.jpg', null, array('class'=>'image cat_img')) !!}
            <h3>Subcategoria 5</h3>
            <p><a href="{{url('event')}}" class="btn btn-primary" role="button" data-target="#info" data-whatever="@mdo">Ver más</a></p>
        </div>
        <div class="col-sm-3">
            {!! Html::image('images/pics13.jpg', null, array('class'=>'image cat_img')) !!}
            <h3>Subcategoria 6</h3>
            <p><a href="{{url('event')}}" class="btn btn-primary" role="button"  data-target="#info" data-whatever="@mdo">Ver más</a></p>
        </div>
        <div class="col-sm-3">
            {!! Html::image('images/pics13.jpg', null, array('class'=>'image cat_img')) !!}
            <h3>Subcategoria 7</h3>
            <p><a href="{{url('event')}}" class="btn btn-primary" role="button"  data-target="#info" data-whatever="@mdo">Ver más</a> </p>
        </div>
        <div class="col-sm-3">
            {!! Html::image('images/pics13.jpg', null, array('class'=>'image cat_img')) !!}
            <h3>Subcategoria 8</h3>
            <p><a href="{{url('event')}}" class="btn btn-primary" role="button"  data-target="#info" data-whatever="@mdo">Ver más</a></p>
        </div>
    </div>
@stop

@section('javascript')

@stop