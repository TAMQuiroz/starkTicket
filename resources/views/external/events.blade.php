@extends('layoutExternal')

@section('style')
    {!!Html::style('css/images.css')!!}
    <style type="text/css">
        #nav .third{
            color: white;
        }
        .input-group{
            width:600px;
        }
        .btn-primary{
            background-color: #83D3C9;
            border-color: #83D3C9;
            margin-left: 50px;
        }
        .btn-primary:hover{
            background-color: #329DB7;
            border-color: #329DB7;
        }
    </style>
@stop

@section('title')
	Eventos
@stop

@section('content')
<h5>Búsqueda</h5>
<div class="input-group">
    {!! Form::text('search', '', array('class' => 'form-control')) !!}
    <span class="input-group-btn">
        <button class="btn btn-primary" type="button">Buscar</button>
    </span>
</div>
<br><br>
<div class="row">
    @foreach($events as $event)
    <div class="3u">
        <section>
            <a href="#" class="image full">{!! Html::image('images/pics13.jpg', null, array('class'=>'image cat_img')) !!}</a>
            <h3>{{$event->name}}</h3>
            <p>
                <b>Fecha: </b> 20/12/2015<br>
                <b>Lugar: </b> {{$event->place->name}} <br>
                <b>Direccion:</b> {{$event->place->address}} <br>
            </p>
            <p><a href="event/{{$event->id}}"  class="btn btn-primary" role="button" >Detalle</a></p>
        </section>
    </div>
    @endforeach
</div>
@stop

@section('javascript')

@stop