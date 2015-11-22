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
                                    <li data-target="#carousel-example-generic" data-slide-to="{{$i}}"></li>
                                    @endfor
                            </ol>
                            <!-- Wrapper for jose slides -->
                            <div class="carousel-inner">
                            @if( $giftArray->count() == 0 ) 

                                <div class="item active">
                                 {!! Html::image('images/imagen-canjea.jpg', null, array()) !!}
                                </div>
                            @else
                                @foreach($giftArray as $gift)
                                @if($gift->id == 1)
                                <div class="item active">
                                @else
                                    <div class="item">
                                @endif         
                                        {!! Html::image( $gift->image , null,  array() ) !!}
                                        <div class="carousel-caption" style="color:black">
                                            <h3>{{$gift->name}}</h3>
                                            <p>Puntos: {{$gift->points}}</p>
                                            <p>Stock: {{$gift->stock}}</p>
                                            @if($gift->stock<=0)
                                            <p style="color:red">Agotado!!!</p>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            @endif 
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
                                {!! Form::hidden('nombre_de_usuario', null, ['id'=>'user_id'])!!}
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
                            <button id="exchange" class="btn btn-info" title="Create"  data-toggle="modal" data-target="#saveModal">Canjear puntos</button>
                        </div>    
                        <!-- MODAL -->
                          <div class="modal fade"  id="saveModal">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                  <h4 class="modal-title">¿Estas seguro que desea canjear el regalo?</h4>
                                </div>
                                <div class="modal-body">
                                  <h5 class="modal-title">Los cambios serán permanentes</h5>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-info" data-dismiss="modal">No</button>                        
                                    <button id = "botonModal" type="submit" class="btn btn-info">Sí</button>
                                </div>
                              </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                          </div><!-- /.modal -->
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
        var list = document.getElementById("dd-list");
        var idgift = list.options[list.selectedIndex].value;
        var id = parseInt(idgift-1);
        $('#carousel-example-generic').carousel(id);

    });

    $('#botonModal').click(function(){
        $("#saveModal").modal('toggle');
    });

    </script>
@stop