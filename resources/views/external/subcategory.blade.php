@extends('layoutExternal')

@section('style')
    {!!Html::style('css/images.css')!!}
@stop

@section('title')
	{{$category->name}}
@stop

@section('content')
    @if($events->count() != 0)
        <div class="row">
            <?php $i = 0; ?>
        @foreach($events as $event)
        <div class="col-sm-3">
            {!! Html::image($event->image, null, array('class'=>'image cat_img')) !!}
            <h3>{{$event->name}}</h3>
            <b>Fecha de venta: </b> {{date('Y-m-d',$event->selling_date)}}<br>
            <b>Lugar: </b> {{$event->place->name}} <br>
            <b>Direccion:</b> {{$event->place->address}} <br>
            <p><a href="{{ url('event/'.$event->id) }}"  class="btn btn-info" >{{$event->name}}</a></p>
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
    @else
        <div class="alert alert-danger">Eventos no encontrados</div>
    @endif
@stop

@section('javascript')

@stop