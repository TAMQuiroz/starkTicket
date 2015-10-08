@extends('layout.admin')

@section('style')
    {!!Html::style('css/images.css')!!}
@stop

@section('title')
	Canjeo de premios
@stop

@section('content')
        <!-- Portfolio Item Row -->
        <div class="row">
            <div class="col-md-7">
                <div id="carousel" class="carousel slide" data-ride="carousel" data-interval="0">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#carousel" data-slide-to="0" class="active"></li>
                        @for($i = 1; $i <= count($gifts)-1; $i++)
                        <li data-target="#carousel" data-slide-to="{{$i}}"></li>
                        @endfor
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <div class="item active">
                            {!! Html::image('images/voidInterno.png', null, array()) !!}
                        </div>
                        @foreach($gifts as $gift)
                        <div class="item">
                            {!! Html::image($gift->image, null, array('class'=>'carousel_img')) !!}
                            <div class="carousel-caption">
                                <h3>{{$gift->name}}</h3>
                                <p>Puntos: {{$gift->points}}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Controls -->
                    <a class="left carousel-control" href="#carousel" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </a>
                    <a class="right carousel-control" href="#carousel" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                </div>
            </div>

            <div class="col-md-4">
                <h2>Void 500 pts</h2><h4>Stock 50 unidades </h4>
                <button type="button" class="btn btn-info">Buscar Cliente </button>
                <br>
                Nombre:  
                <input disabled type="text" name="fname" style="
                width: 174px;
                padding-top: 3px;
                margin-top: 40px;
                 margin-left: 3px;
                border-left-width: 2px;
                border-right-width: 2px;
                margin-bottom: 15px;
               "><br>
               Puntos:
               <input disabled type="text" name="lname" style="
                margin-bottom: 10‒;
                margin-bottom: 0px;
                border-left-width: 2px;
                margin-left: 8px;">
                <br>  <br>
                <button type="button" class="btn btn-info">  Canjear puntos  </button>
            </div>
        </div>
        <!-- /.row -->

        <!-- Related Projects Row -->
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">Premios Destacados</h3>
            </div>
            
            @foreach($gifts as $gift)
            <div class="col-sm-3 col-xs-6">
                <a href=" "> 
                    {!! Html::image($gift->image, null, array('class'=>'gift-highlight img-responsive img-hover img-related')) !!}
                </a>
                <h4 class="text-center">{{$gift->name}}</h4>
                <h5 class="text-center">Puntos: {{$gift->points}}</h5>
            </div>
            @endforeach
        </div>
        <!-- /.row -->

@stop

@section('javascript')


@stop