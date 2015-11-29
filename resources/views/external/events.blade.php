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
    {!! Form::text('search', '', array('class' => 'form-control', 'id' => 'textSearch')) !!}
    <span class="input-group-btn">
        <a href="#" class="btn btn-info" id="searchButton">Buscar</a>
    </span>
</div>
<div class="container">
    <hr>
    <div class="row">
        <?php $i = 0;  ?>
        @foreach($events as $event)
        <div class="3u col-sm-3">
            <a  class="image full">{!! Html::image($event->image, null, array('class'=>'image cat_img')) !!}</a>
            <h3>{{$event->name}}</h3>
            <p>
                <b>Fecha de ventas: </b> {{date('Y-m-d',$event->selling_date)}}<br>
                <b>Lugar: </b> {{$event->place->name}} <br>
                <b>Direccion:</b> {{$event->place->address}} <br>
                <b>Categoria:</b> {{$event->category->name}} <br>
            </p>
            <p><a href="event/{{$event->id}}"  class="btn btn-info" role="button" >Detalle</a></p>
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

        <div class="col-md-12">{!! $events->render() !!}</div>
    </div>
</div>
@stop

@section('javascript')
<script type="text/javascript">
    $( document ).ready(function() {
        $('#searchButton').on('click',function(){
            var titulo = $('#textSearch').val();
            $('#searchButton').attr('href', '?title='+titulo);
        });
    });
</script>

@stop

