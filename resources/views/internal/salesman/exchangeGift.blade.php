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
                     {!!Form::open(array('url' => 'salesman/exchange_gift','files'=>true,'id'=>'form','class'=>'form-horizontal'))!!}
                                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-interval="0">
                            <!-- Indicators -->
                            <ol class="carousel-indicators">
                                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                                           @for ($i = 0; $i <  $giftArray->count(); $i++)
                                    <li data-target="#carousel-example-generic" data-slide-to= {{$i}}></li>
                                @endfor
                                                  </ol>
                            <!-- Wrapper for jose slides -->
                            <div class="carousel-inner">
                                <div class="item active">
                                {!! Html::image('images/imagen-canjea.jpg', null, array()) !!}
                                </div>
                                @foreach($giftArray as $gift)
                                    <div class="item">
                                        {!! Html::image( $gift->image , null,  array() ) !!}
                                    </div>
                                @endforeach
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
                             {!! Form::number('number', null, ['class' => 'form-control', 'placeholder' => 'Documento de Identidad...','id'=>'user_di','min'=>0,'max'=>99999999]) !!}
            <br><br>
                  <h4>Nombre Usuario</h4>
                    <div class="input-group" style="width:290px">
                        {!! Form::text('name', null, ['class' => 'form-control', 'disabled', 'id'=>'user_name']) !!}
                        {!! Form::hidden('user_id', null, ['id'=>'user_id'])!!}
                        <br><br>
                        <h4>Puntos Acumulados</h4>
                        {!! Form::text('points', null, ['class' => 'form-control', 'disabled', 'id'=>'user_points']) !!}
                    </div><!-- /input-group -->
                        <br>
                                 </div>
                                   <div class="col-md-8">
                            <h4>Regalos</h4>
                            {!! Form::select('gifts',  $giftsList->toArray()  , null, ['class' => 'form-control','id' => 'dd-list' ,'required'])!!}
                        </div>
                                          <div class="col-md-8" style="margin-top:20px">
                                                  <button type="submit" class="btn btn-info">Canjear puntos</button>
                        </div>    
                    </div>
                </div>
                <!-- /.row -->

                <!-- Related Projects Row -->
                <div class="row">

                    <div class="col-lg-12">
                        <h3 class="page-header">Premios Destacados</h3>
                    </div>

        @for ($i = 0; $i <  $giftArray->count()  and $i< 4; $i++)
             <div class="col-sm-3 col-xs-6">
                        <a href="#"> 
                        <img class="img-responsive img-hover img-related"
                                     {!! Html::image( $giftArray[$i]->image , null, array()) !!}
                                            </a>
                    </div>
        @endfor

                </div>
                <!-- /.row -->
                  @stop
        @section('javascript')

           
            {!!Html::script('js/main.js')!!}

            <script type="text/javascript">
            var config = {
                routes: [
                    { zone: "{{ URL::route('ajax.getClient') }}" },
               
                ]
            };
            $('#yes').click(function(){
                $('#submitModal').modal('hide');  
            });

            $('#dd-list').change(function(){
                //alert('gg');
                var list = document.getElementById("dd-list");
                var idgift = list.options[list.selectedIndex].value;
                var id = parseInt(idgift);
                $('#carousel-example-generic').carousel(id);
                //alert(id);

            });

            </script>
        @stop