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
	{{$category->name}}
@stop

@section('content')
    @if($events)
        <div class="row">
        @foreach($events as $event)

        <div class="col-sm-3">
            {!! Html::image($event->image, null, array('class'=>'image cat_img')) !!}
            <h3>{{$event->name}}</h3>
            <p><a href="{{ url('event/'.$event->id) }}"  class="btn btn-primary" >{{$event->name}}</a></p>
        </div>

        @endforeach
        </div>
    @else
        <div class="alert alert-danger">Eventos no encontrados</div>
    @endif
@stop

@section('javascript')

@stop