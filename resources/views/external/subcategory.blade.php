@extends('layoutExternal')

@section('style')

@stop

@section('title')
	{{$category->name}}
@stop

@section('content')
    @if($events)
        <div class="row">
        @foreach($events as $event)

        <div class="col-sm-3">
            {!! Html::image('images/pics13.jpg', null, array('class'=>'image cat_img')) !!}
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