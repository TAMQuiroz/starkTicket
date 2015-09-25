@extends('layoutExternal')

@section('style')
    {!!Html::style('css/images.css')!!}
@stop

@section('title')
	Categorias
@stop

@section('content')
	<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
    <div class="row">
        <div class="col-sm-3">
            {!! Html::image('images/pics13.jpg', null, array('class'=>'image cat_img')) !!}
            <h3>Categoria 1</h3>
            <p><a href="{{url('event')}}" class="btn btn-primary" role="button" data-target="#info" data-whatever="@mdo">Ver más</a></p>
        </div>
        <div class="col-sm-3">
            {!! Html::image('images/pics13.jpg', null, array('class'=>'image cat_img')) !!}
            <h3>Categoria 2</h3>
            <p><a href="{{url('event')}}" class="btn btn-primary" role="button"  data-target="#info" data-whatever="@mdo">Ver más</a></p>
        </div>
        <div class="col-sm-3">
            {!! Html::image('images/pics13.jpg', null, array('class'=>'image cat_img')) !!}
            <h3>Categoria 3</h3>
            <p><a href="{{url('event')}}" class="btn btn-primary" role="button"  data-target="#info" data-whatever="@mdo">Ver más</a> </p>
        </div>
        <div class="col-sm-3">
            {!! Html::image('images/pics13.jpg', null, array('class'=>'image cat_img')) !!}
            <h3>Categoria 4</h3>
            <p><a href="{{url('event')}}" class="btn btn-primary" role="button"  data-target="#info" data-whatever="@mdo">Ver más</a></p>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            {!! Html::image('images/pics13.jpg', null, array('class'=>'image cat_img')) !!}
            <h3>Categoria 5</h3>
            <p><a href="{{url('event')}}" class="btn btn-primary" role="button"  data-target="#info" data-whatever="@mdo">Ver más</a></p>
        </div>
        <div class="col-sm-3">
            {!! Html::image('images/pics13.jpg', null, array('class'=>'image cat_img')) !!}
            <h3>Categoria 6</h3>
            <p><a href="{{url('event')}}" class="btn btn-primary" role="button"  data-target="#info" data-whatever="@mdo">Ver más</a></p>
        </div>
        <div class="col-sm-3">
            {!! Html::image('images/pics13.jpg', null, array('class'=>'image cat_img')) !!}
            <h3>Categoria 8</h3>
            <p><a href="{{url('event')}}" class="btn btn-primary" role="button" data-target="#info" data-whatever="@mdo">Ver más</a></p>
        </div>
        <div class="col-sm-3">
            {!! Html::image('images/pics13.jpg', null, array('class'=>'image cat_img')) !!}
            <h3>Categoria 7</h3>
            <p><a href="{{url('event')}}" class="btn btn-primary" role="button" data-toggle="modal" data-target="#info" data-whatever="@mdo">Ver más</a></p>
        </div>
    </div>
    <div id="info" class="modal fade" role="dialog">
                      <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-body">
                            <h2>Descripcion</h2>
                            <h4>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</h4>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          </div>
                        </div>

                      </div>
                    </div>
      </div>
@stop

@section('javascript')

@stop