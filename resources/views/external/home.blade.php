@extends('layoutExternal')

@section('style')
    <style type="text/css">
        #nav .first{
            color: white;
        }
        .input-group{
            width:600px;
        }
        .btn-info{
            background-color: #83D3C9;
            border-color: #83D3C9;
        }
        .btn-info:hover{
            background-color: #329DB7;
            border-color: #329DB7;
        }
    </style>
@stop

@section('title')
	Welcome...lelelelelele
@stop

@section('content')
	<h5>Búsqueda</h5>
    <div class="input-group">
        <input type="text" class="form-control" placeholder=" ">
        <span class="input-group-btn">
            <button class="btn btn-info" type="button">Buscar</button>
        </span>
    </div>
    <br><br>
         <div class="row">

            <div class="col-md-7" style="left:300px">
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-interval="0">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="3"></li>
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <div class="item active">
                            <img class="img-responsive" src="images/peppa.jpg" alt="">

                        </div>
                        <div class="item">
                            <img class="img-responsive" src="images/jaja.jpg" alt="">

                        </div>
                        <div class="item">
                            <img class="img-responsive" src="images/arctic.jpg" alt="">

                        </div>
                        <div class="item">
                            <img class="img-responsive" src="images/bruta.jpg" alt="">
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
                 
        <br>  <br>
       

            </div>

        </div>
        <!-- /.row -->

        <!-- Related Projects Row -->
        <div class="row">

            <div class="col-lg-12">
                <h3 class="page-header">Eventos próximos</h3>
            </div>

            <div class="col-sm-3 col-xs-6">
                <a href="#">
                    <img class="img-responsive img-hover img-related" src="images/bruta.jpg"  alt="">
                    <br><br>
                    Fuerza Bruta
                </a>
            </div>

       

            <div class="col-sm-3 col-xs-6">
                <a href="#">
                    <img class="img-responsive img-hover img-related" src="images/peppa.jpg" alt="">
                    El circo de Doña Peppa
                </a>
            </div>

            <div class="col-sm-3 col-xs-6">
                <a href="#">
                    <img class="img-responsive img-hover img-related" src="images/arctic.jpg" alt="">
                     El concierto de los Arctic Monkeys
                </a>
            </div>

        </div>
        <!-- /.row -->

        <hr>

@stop

@section('javascript')

@stop