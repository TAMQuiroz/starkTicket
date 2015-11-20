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
        <button class="btn btn-info" type="button">Buscar</button>
    </span>
</div>
<br><br>
<div class="row">
    @foreach($events as $event)
    <div class="3u">
        <section>
            <a href="#" class="image full">{!! Html::image($event->image, null, array('class'=>'image cat_img')) !!}</a>
            <h3>{{$event->name}}</h3>
            <p>
                <b>Fecha de venta: </b> {{date('Y-m-d',$event->selling_date)}}<br>
                <b>Lugar: </b> {{$event->place->name}} <br>
                <b>Direccion:</b> {{$event->place->address}} <br>
            </p>
            <p><a href="event/{{$event->id}}"  class="btn btn-info" role="button" >Detalle</a></p>
        </section>
    </div>
    @endforeach
</div>
@stop

@section('javascript')

@stop

