@extends('layout.admin')

@section('style')
  {!!Html::style('css/adminGifts.css')!!}
@stop

@section('title')
	Regalos
@stop

@section('content')

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Canjeo de premios
                    <small>Muñeco void</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="index.html">Home</a>
                    </li>
                    <li class="active">Premios Item</li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <!-- Portfolio Item Row -->
        <div class="row">

            <div class="col-md-7">
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-interval="0">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <div class="item active">
                            <img class="img-responsive" src="images/voidInterno.png" alt="">
                        </div>
                        <div class="item">
                            <img class="img-responsive" src="images/pudgeInterno.png" alt="">
                        </div>
                        <div class="item">
                            <img class="img-responsive" src="images/rilayInterno.png" alt="">
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
                 <h2>Void 500 pts</h2><h4>Stock 50 unidades </h4>  
        <br>  <br>
        <button type="button" class="btn btn-info">Buscar Cliente </button>
        <br>
  Nombre:  <input type="text" name="fname" style="
    width: 174px;
    padding-top: 3px;
    margin-top: 40px;
     margin-left: 3px;
    border-left-width: 2px;
    border-right-width: 2px;
    margin-bottom: 15px;
   "><br>
   Puntos:
   
   <input type="text" name="lname" style="
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

            <div class="col-sm-3 col-xs-6">
                <a href="#">
                    <img class="img-responsive img-hover img-related" src="images/void 500 300.png"  alt="">
                </a>
            </div>

            <div class="col-sm-3 col-xs-6">
                <a href="#">
                    <img class="img-responsive img-hover img-related" src="images/pudge 500 300.png" alt="">
                </a>
            </div>

            <div class="col-sm-3 col-xs-6">
                <a href="#">
                    <img class="img-responsive img-hover img-related" src="images/rilay 500 300.png" alt="">
                </a>
            </div>

            <div class="col-sm-3 col-xs-6">
                <a href="#">
                    <img class="img-responsive img-hover img-related" src="images/gondar 500 300.jpg" alt="">
                </a>
            </div>

        </div>
        <!-- /.row -->

        <hr>

@stop

@section('javascript')



@stop