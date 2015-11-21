@extends('layoutExternal')

@section('style')
<style>
    #map {
        width: 400px;
        height: 400px;
    }
</style>
{!!Html::style('css/images.css')!!}
@stop

@section('title')
{{$event->name}}
@stop

@section('content')
    @if (Session::has('bookingmailmessage'))
        <div class="alert alert-info">{{ Session::get('bookingmailmessage') }}</div>
    @endif
<!-- Main -->
<div id="main">

    <div class="row">

        <!-- Content -->
        <div id="content" class="8u skel-cell-important">
            {!!Form::open(array('url' => 'event/'.$event->id.'/' ,'files'=>true,'id'=>'form','class'=>'form-horizontal'))!!}

            <section>
                <p><a href="#" class="image full">{!! Html::image($event->image, null,['class'=>'carousel_img']) !!}</a></p>
                <p>{{ $event->description }}</p>
                <br>
                <div class="table-responsive">
                    <table class="table table-bordered" style="widht:1px">
                        <thead>
                            <tr>
                                <th>Zona</th>
                                <th>Precio</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($event->zones as $zone)
                            <tr>
                                <td>{{$zone->name}}</td>
                                <td>S/. {{$zone->price}}</td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>

                            </div>
                            @if(isset($user) && $user->role_id == config('constants.salesman'))
                            <a href="{{url('salesman/event/'.$event->id.'/buy')}}"><button type="button" class="btn btn-info">Comprar Entrada</button></a>
                            @else
                            <a href="{{url('client/event/'.$event->id.'/buy')}}"><button type="button" class="btn btn-info">Comprar Entrada</button></a>
                            <a href="{{url('client/'.$event->id.'/reservanueva')}}"><button type="button" class="btn btn-info">Reservar Entrada</button></a>
                            @endif
                            
                            <br>
                     
                            @if(isset($user) && $user->role_id == config('constants.client'))
                            <br><br>
                            <div class="form-group">
                                <label for="comment">Ingrese comentario:</label>
                                {!! Form::textarea('comment', null, ['class' => 'form-control', 'rows' => '5']) !!}
                                <button type="submit" class="btn btn-info">Aceptar</button>
                                <br>


                            @else
                            <div class="form-group">
                            @endif    
                                <br>
                                <label for="comment">Comentarios:</label>

                                @foreach ($Comments as $Comment)
                                <br>
                                <h6>{{$users[($Comment->user_id)-1]['name'] }} {{ date ( "d-m-Y H:ia" , strtotime( $Comment->time )) }}</h6>
                                {!! Form::textarea('pastComment1', null, ['class' => 'form-control', 'rows' => '3', 'placeholder'=> $Comment->description, 'readonly']) !!}
                                @if(isset($user) && $user->role_id == config('constants.admin'))
                                <button type="button" class="btn btn-info" style="float:right" data-toggle="modal" data-target="#deleteModal">Eliminar</button>
                                <!-- MODAL -->
                                <div class="modal fade"  id="deleteModal">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">¿Estas seguro que desea eliminar el comentario?</h4>
                                      </div>
                                      <div class="modal-body">
                                        <h5 class="modal-title">Los cambios serán permanentes</h5>
                                      </div>
                                      <div class="modal-footer">
                                          <button type="button" class="btn btn-info" data-dismiss="modal">No</button>
                                         <a class="btn btn-info" href="{{url('event/delete/'.$Comment->id.'/comment')}}" title="Delete" >Sí</a>
                                                 </div>
                
                                    </div><!-- /.modal-content -->
                                  </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
                                @endif
                                @endforeach

                            </div>
                        </section>
                    </div>
                    <!-- /Content -->

                    <!-- Sidebar -->
                    <div id="sidebar" class="4u">
                        <section>
                            <header>
                                <h2 class="detail">Detalle de evento</h2>
                                <!--<span class="byline">Praesent lacus congue rutrum</span>-->
                            </header>
                            <h3 class="dates">Fechas del evento</h3>

                            <p>Del {{date("d/m/Y", $event->presentations->first()->starts_at)}} Al {{date("d/m/Y", $event->presentations->last()->starts_at)}}</p>
                            <h3 class="dates">Horario</h3>
                            <p>Función a las {{date("H:i", $event->presentations->first()->starts_at)}}</p>
                            <h3 class="dates">Ubicación</h3>

                            <p>{{$event->place->address}}, {{$event->place->district}}</p>
                            {!! Html::image($event->place->image,null, ['class'=>'carousel_img']) !!}

                            <h3 class="dates">Distribución de Zonas</h3>
                            <p>{!! Html::image($event->distribution_image,null, ['class'=>'carousel_img']) !!}</p>
                        </section>
                    </div>
                    <!-- Sidebar -->

                </div>
                                </section>
            </div>
            <!-- /Content -->
            </div>
    </div>
    <!-- Main -->

    @stop

    @section('javascript')
    <script src="https://maps.googleapis.com/maps/api/js"></script>
    <script>
        function initialize() {
            var mapCanvas = document.getElementById('map');
            var mapOptions = {
                center: new google.maps.LatLng(-12.087444,-77.054986),
                zoom: 14,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            }
            var map = new google.maps.Map(mapCanvas, mapOptions)
        }
        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
    <script type="text/javascript">
        var price = 10; //price
        $(document).ready(function() {
            var $cart = $('#selected-seats'), //Sitting Area
            $counter = $('#counter'), //Votes
            $total = $('#total'); //Total money

            var sc = $('#seat-map').seatCharts({
                map: [  //Seating chart
                'aaaaaaaaaa',
                'aaaaaaaaaa',
                '__________',
                'aaaaaaaaaa',
                'aaaaaaaaaa',
                'aaaaaaaaaa',
                'aaaaaaaaaa',
                'aaaaaaaaaa',
                'aaaaaaaaaa',
                'aa__aa__aa'
                ],
                naming : {
                    top : false,
                    getLabel : function (character, row, column) {
                        return column;
                    }
                },
                legend : { //Definition legend
                    node : $('#legend'),
                    items : [
                    [ 'a', 'available',   'Libre' ],
                    [ 'a', 'unavailable', 'Ocupado'],
                    [ 'a', 'reserved', 'Reservado']
                    ]
                },
                click: function () { //Click event
                    if (this.status() == 'available') { //optional seat
                        $('<li>R'+(this.settings.row+1)+' S'+this.settings.label+'</li>')
                        .attr('id', 'cart-item-'+this.settings.id)
                        .data('seatId', this.settings.id)
                        .appendTo($cart);

                        $counter.text(sc.find('selected').length+1);
                        $total.text(recalculateTotal(sc)+price);

                        return 'selected';
                    } else if (this.status() == 'selected') { //Checked
                            //Update Number
                            $counter.text(sc.find('selected').length-1);
                            //update totalnum
                            $total.text(recalculateTotal(sc)-price);

                            //Delete reservation
                            $('#cart-item-'+this.settings.id).remove();
                            //optional
                            return 'available';
                    } else if (this.status() == 'unavailable') { //sold
                        return 'unavailable';
                    } else if (this.status() == 'reserved'){
                        return 'reserved';
                    } else {
                        return this.style();
                    }
                }
            });
            //sold seat
            sc.get(['4_4','4_5','6_6','6_7','8_5','8_6','8_7','8_8', '10_1', '10_2']).status('unavailable');
            sc.get(['1_1','5_5']).status('reserved');

        });
        //sum total money
        function recalculateTotal(sc) {
            var total = 0;
            sc.find('selected').each(function () {
                total += price;
            });

            return total;
        }
    </script>
    @stop