@extends('layout.salesman')

@section('style')
    {!!Html::style('css/seats.css')!!}
    {!!Html::style('css/admin.css')!!}
@stop

@section('title')
	Nueva Venta - Entradas
@stop

@section('content')
    {!!Form::open(array('route' => 'ticket.store','id'=>'form'))!!}
        <legend>Información del evento</legend>
        <div class="select Type"> 
            <label>
                <div class="col-md-4">
                    <h4 class="boxy"> Codigo del Evento </h4>
                    {!! Form::text('code', $event->id, ['class' => 'form-control boxy', 'disabled','id'=>'event_id']) !!}
                    {!!Form::hidden('event_id',$event['id'])!!}
                </div>
                <div class="col-md-4">
                    <h4 > Nombre del Evento </h4>
                    {!! Form::text('event_name', $event->name, ['class' => 'form-control', 'disabled']) !!}
                </div>
                <div class="col-md-4">
                    <h4 >Entradas Disponibles</h4>
                    {!! Form::text('available', null, ['id'=>'available','class' => 'form-control', 'disabled']) !!}  
                </div>
                <div class="col-md-4">
                    <h4 class="boxy"> Funciones del evento </h4>
                    {!! Form::select('presentation_id', $presentations, null, ['class' => 'form-control boxy', 'id'=>'pres_selection', 'onChange'=>'getAvailable(); getSlots()']) !!}
                </div>
                <div class="col-md-4"> 
                    <h4 > Zona del Evento </h4>
                    {!! Form::select('zone_id', $zones, null, ['class' => 'form-control','onChange'=>'getAvailable(); getPrice(); getSlots(); makeArray()','id'=>'zone_id']) !!}
                </div>
                <div class="col-md-4">
                    <h4> Promoción </h4>
                    {!! Form::select('promotion_id', ['Ninguna', 'Pre-venta', 'Visa Platinium'], null, ['class' => 'form-control']) !!}
                </div>
            </label>
        </div>
        <br>
        <div class="table-responsive col-md-12" >
          <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Zona</th>
                    <th>Precio</th>
                </tr>
            </thead>
            <tbody>
                @foreach($event->zones as $zone)
                <tr>
                    <td>{{$zone->name}}</td>
                    <td>S/. {{$zone->price}}</td>
                </tr>
                @endforeach
            </tbody>
          </table>
        </div>
            <legend>Información del cliente</legend>
            <div class="col-md-6">
                <h4>Ingrese Usuario</h4>
                {!! Form::number('number', null, ['class' => 'form-control', 'placeholder' => 'Documento de Identidad...','id'=>'user_di','min'=>0,'max'=>99999999]) !!}
            </div>
            <div class="col-md-6">
                <h4>Nombre de Cliente</h4>
                {!! Form::text('name', null, ['class' => 'form-control', 'disabled', 'id'=>'user_name']) !!}
                {!! Form::hidden('user_id', null, ['id'=>'user_id'])!!}
            </div>


        @if($event->place->rows != null)
            
        
        <legend>Selección de Ubicación</legend>
        <div class="seats">
            <div class="demo">
                <div id="parent-map">
                    <div id="seat-map"></div>
                </div>
                <br>
                <div class="booking-details">
                    <h4 style="text-decoration:underline;text-align: center;">Resumen</h4>
                    <p>Evento: <span> {{$event->name}}</span></p>
                    <p>Asiento(s): </p>
                    <ul id="selected-seats"></ul>
                    <p>Tickets: <span id="counter">0</span></p>
                    <p>Total: <b>S/.<span id="total">0</span></b></p>
                    <div id="legend"></div>
                </div>
                <div style="clear:both"></div>
           </div>
        </div>
        <div class="col-md-2">
            {!!Form::select('seats[]',head($slots_array), null,['class'=>'form-control','id'=>'seats','multiple','onClick'=>'addQuantity(this)'])!!}
        </div>
        <div class="col-md-3">
            Cantidad: {!!Form::number('quantity',0,['id'=>'quantity','readonly', 'class'=>'form-control'])!!}
        </div>
        @else
        
        <div class="col-md-3">
            Cantidad: {!!Form::number('quantity',0,['id'=>'quantity','class'=>'form-control','min'=>'1'])!!}
        </div>
        @endif
        <!-- Content Row -->
        <!-- /.row -->
        
        <div class="col-md-12"><hr></div>
        <div class= "button-final col-md-12">
            <button type="button" id="payModal" class="btn btn-info" data-toggle="modal" data-target="#mix2" data-whatever="@mdo" disabled="">Realizar Pago</button>
            <a href="{{url('salesman/')}}"><button type="button" class="btn btn-info">Cancelar Venta</button></a>
            <button type="button" class="btn btn-info" data-dismiss="modal" data-target="#visualizarVenta"><i class="glyphicon glyphicon-print"></i></button>

            <div class="modal fade" id="mix2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="exampleModalLabel">Detalle de Pago:</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Monto a Pagar</label>
                                {!!Form::number('',null,['id'=>'total2','class'=>'form-control','readonly','placeholder'=>'S/.'])!!}
                                <br>
                                <div class="form-group checkbox pay">
                                    <label>
                                        {!!Form::radio('payMode', 0, null,['id'=>'creditCardPay'])!!}Pago con tarjeta
                                    </label>
                                    <hr>
                                    <label for="exampleInputEmail2">Número de Tarjeta</label>
                                    {!!Form::number('',null,['id'=>'creditCardNumber','class'=>'form-control','placeholder'=>'1234 5678 9012 3456','disabled','min'=>1, 'max'=>9999999999999999,'required'])!!}
                                    <label for="exampleInputEmail2">Fecha de expiración</label>
                                    <input type="date" id="expirationDate" class="form-control" disabled="true" min="{{date("Y-m-j")}}" required>
                                    <label for="exampleInputEmail2">Código de Seguridad</label>
                                    {!!Form::number('',null,['id'=>'securityCode','class'=>'form-control','placeholder'=>'123','disabled','min'=>0,'max'=>999,'required'])!!}
                                </div>
                                <br>  
                                <div class="form-group checkbox pay">
                                    <label>
                                        {!!Form::radio('payMode', 1, null,['id'=>'cashPay'])!!}Pago con efectivo
                                    </label>
                                    <h5>Tipo de Cambio: S/.2.90</h5>
                                    <hr>
                                    <label for="exampleInputEmail2">Monto Ingresado</label>
                                    {!!Form::number('',null,['id'=>'amountIn','class'=>'form-control','placeholder'=>'S/. ','disabled','min'=>0])!!}
                                    <label for="exampleInputEmail2">Vuelto</label>
                                    {!!Form::text('',null,['id'=>'change','class'=>'form-control','placeholder'=>'S/. ','readonly'])!!}
                                </div>
                                <br>  
                                <div class="form-group checkbox pay">
                                    <label>
                                        {!!Form::radio('payMode', 2, null,['id'=>'mixPay'])!!}Pago mixto
                                    </label>
                                    <hr>
                                    <label for="exampleInputEmail2">Cantidad a pagar en efectivo</label>
                                    {!!Form::number('paymentMix',null,['id'=>'paymentMix','class'=>'form-control','placeholder'=>'S/. ','disabled','min'=>0])!!}
                                    <label for="exampleInputEmail2">Monto Ingresado</label>
                                    {!!Form::number('paymentMix',null,['id'=>'amountMix','class'=>'form-control','placeholder'=>'S/. ','disabled','min'=>0])!!}
                                    <label for="exampleInputEmail2">Vuelto</label>
                                    {!!Form::text('',null,['id'=>'changeMix','class'=>'form-control','placeholder'=>'S/. ','readonly'])!!}
                                    <br>
                                    {!!Form::submit('Pagar Entrada',array('id'=>'pay','class'=>'btn btn-info', 'disabled'))!!}
                                    <button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    {!!Form::close()!!}


@stop

@section('javascript')
	{!!Html::script('js/jquery.seat-charts.min.js')!!}
	{!!Html::script('js/seats.js')!!}
    {!!Html::script('js/main.js')!!}

    <script type="text/javascript">
        var config = {
        routes: [
            { zone: "{{ URL::route('ajax.getClient') }}" },
            { price_ajax: "{{ URL::route('ajax.getPrice') }}" },
            { event_available: "{{URL::route('ajax.getAvailable')}}"},
            { slots: "{{URL::route('ajax.getSlots')}}"},
            { makeArray: "{{URL::route('ajax.getZone')}}"}
        ]
    };
    </script>
        
@stop