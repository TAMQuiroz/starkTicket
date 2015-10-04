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
    <div class="3u">
        <section>
            <a href="#" class="image full">{!! Html::image('images/pics13.jpg', null, array('class'=>'image cat_img')) !!}</a>
            <h3>Titulo del Evento 1</h3>
            <p><b>Precio: </b> S/. 20.00 <br>
                <b>Fecha: </b> 20/12/2015<br>
                Av. venezuela Nro 255 </p>
            <p><a href="event/1"  class="btn btn-primary" role="button" >Detalle</a></p>
        </section>
    </div>
    <div class="3u">
        <section>
            <a href="#" class="image full">{!! Html::image('images/pics13.jpg', null, array('class'=>'image cat_img')) !!}</a>
            <h3>Titulo del Evento 2</h3>
            <p><b>Precio: </b> S/. 20.00 <br>
                <b>Fecha: </b> 20/12/2015<br>
                Av. venezuela Nro 255 </p>
            <p><a href="event/1"  class="btn btn-primary" role="button" >Detalle</a></p>
        </section>
    </div>
    <div class="3u">
        <section>
            <a href="#" class="image full">{!! Html::image('images/pics13.jpg', null, array('class'=>'image cat_img')) !!}</a>
            <h3>Titulo del Evento 3</h3>
            <p><b>Precio: </b> S/. 20.00 <br>
                <b>Fecha: </b> 20/12/2015<br>
                Av. venezuela Nro 255 </p>
            <p><a href="event/1"  class="btn btn-primary" role="button" >Detalle</a></p>
        </section>
    </div>
    <div class="3u">
        <section>
            <a href="#" class="image full">{!! Html::image('images/pics13.jpg', null, array('class'=>'image cat_img')) !!}</a>
            <h3>Titulo del Evento 4</h3>
            <p><b>Precio: </b> S/. 20.00 <br>
                <b>Fecha: </b> 20/12/2015<br>
                Av. venezuela Nro 255 </p>
            <p> <a href="event/1"  class="btn btn-primary" role="button" >Detalle</a></p>
        </section>
    </div>
</div>
<div class="row">
    <div class="3u">
        <section>
            <a href="#" class="image full">{!! Html::image('images/pics13.jpg', null, array('class'=>'image cat_img')) !!}</a>
            <h3>Titulo del Evento 5</h3>
            <p><b>Precio: </b> S/. 20.00 <br>
                <b>Fecha: </b> 20/12/2015<br>
                Av. venezuela Nro 255 </p>
            <p> <a href="event/1"  class="btn btn-primary" role="button" >Detalle</a></p>
        </section>
    </div>
    <div class="3u">
        <section>
            <a href="#" class="image full">{!! Html::image('images/pics13.jpg', null, array('class'=>'image cat_img')) !!}</a>
            <h3>Titulo del Evento 6</h3>
            <p><b>Precio: </b> S/. 20.00 <br>
                <b>Fecha: </b> 20/12/2015<br>
                Av. venezuela Nro 255 </p>
            <p> <a href="event/1"  class="btn btn-primary" role="button" >Detalle</a></p>
        </section>
    </div>
    <div class="3u">
        <section>
            <a href="#" class="image full">{!! Html::image('images/pics13.jpg', null, array('class'=>'image cat_img')) !!}</a>
            <h3>Titulo del Evento 7</h3>
            <p><b>Precio: </b> S/. 20.00 <br>
                <b>Fecha: </b> 20/12/2015<br>
                Av. venezuela Nro 255 </p>
            <p><a href="event/1" class="btn btn-primary" role="button" >Detalle</a></p>
        </section>
    </div>
    <div class="3u">
        <section>
            <a href="#" class="image full">{!! Html::image('images/pics13.jpg', null, array('class'=>'image cat_img')) !!}</a>
            <h3>Titulo del Evento 8</h3>
            <p><b>Precio: </b> S/. 20.00 <br>
                <b>Fecha: </b> 20/12/2015<br>
                Av. venezuela Nro 255 </p>
            <p> <a href="event/1" class="btn btn-primary" role="button" >Detalle</a></p>
        </section>
    </div>
</div>
@stop

@section('javascript')

@stop