@extends('layout.salesman')

@section('style')
    <style type="text/css">
    .form-control{
        width: 80%;
        display: inline-block;
    }
    h5{
        display: inline-block;
        
    }
    </style>
@stop

@section('title')
	Canjeo de premios
@stop

@section('content')
        <!-- Portfolio Item Made by JosE  Row -->
        <div class="row">

            <div class="col-md-7">

             {!!Form::open(array('url' => 'admin/politics/new','files'=>true,'id'=>'form','class'=>'form-horizontal'))!!}
    
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-interval="0">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                    </ol>

                    <!-- Wrapper for jose slides -->
                    <div class="carousel-inner">
                        <div class="item active">


    <p><a href="#" class="image full">{!! Html::image( $gifts->toArray(0)->image, null,['class'=>'carousel_img']) !!}</a></p>


                        {!! Html::image('images/voidInterno.png', null, array()) !!}
                        </div>
                        <div class="item">
                        {!! Html::image('images/pudgeInterno.png', null, array()) !!}
                        </div>
                        <div class="item">
                        {!! Html::image('images/rilayInterno.png', null, array()) !!}   
                        </div>
                    </div>
                    <!-- Controls -->
                    <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
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
                                   <button type="submit" class="btn btn-info">Buscar</button>
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
                    {!! Form::select('gifts',  $gifts->toArray()  , null, ['class' => 'form-control', 'required'])!!}

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

           
    <div class="col-sm-3 col-xs-6">
                <a href="#"> 
                <img class="img-responsive img-hover img-related"
                             {!! Html::image('images/void 500 300.png', null, array()) !!}
                
                </a>
            </div>


   

    <div class="col-sm-3 col-xs-6">
                <a href="#"> 
                <img class="img-responsive img-hover img-related"
              {!! Html::image('images/pudge 500 300.png', null, array()) !!}
                
                </a>
            </div>


     
    <div class="col-sm-3 col-xs-6">
                <a href="#"> 
                <img class="img-responsive img-hover img-related"
             {!! Html::image('images/rilay 500 300.png', null, array()) !!}
    
                </a>
            </div>


            <div class="col-sm-3 col-xs-6">
                <a href="#"> 
                <img class="img-responsive img-hover img-related"
                
                {!! Html::image('images/gondar 500 300.jpg', null, array()) !!}
       
                </a>
            </div>


        </div>
        <!-- /.row -->

        <hr>

@stop

@section('javascript')



@stop