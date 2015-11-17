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
                                <p>Stock: {{$gift->stock}}</p>
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
                <!--<h2>Void 500 pts</h2><h4>Stock 50 unidades </h4>-->
                <h5>Buscar Cliente</h5>
                <div class="input-group" style="width:290px">
                    {!! Form::text('client', null, array('class' => 'form-control', 'placeholder'=>'Cliente','id'=>'clientS')) !!} 
                    <span class="input-group-btn" type="button">
                        {!!Form::button('Buscar',array('id'=>'btnBuscar','class'=>'btn btn-info'))!!}
                    </span>
                </div><!-- /input-group -->
                <br>
                <div class="col-md-8">
                    <h4>Nombre de Cliente</h4>
                    {!! Form::text('name', null, ['class' => 'form-control', 'disabled', 'id'=>'user_name']) !!}
                </div><br>
                <div class="col-md-8">
                    <h4>Puntos Acumulados</h4>
                    {!! Form::text('points', null, ['class' => 'form-control', 'disabled', 'id'=>'user_points']) !!}
                </div>
                <div class="col-md-8">
                    <h4>Regalos</h4>
                    {!! Form::select('gifts', ['regalo1', 'regalo2'], null, ['class' => 'form-control', 'required'])!!}
                </div>
                <div class="col-md-8" style="margin-top:20px">
                    {!!Form::button('Canjear Puntos',array('id'=>'btnChange','class'=>'btn btn-info'))!!}
                    
                </div>    
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