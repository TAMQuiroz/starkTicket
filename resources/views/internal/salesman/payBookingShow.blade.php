@extends('layout.salesman')

@section('style')
    <style type="text/css">
    #modpay{
        width: 100%;
    margin-left: 0px;
    }
    </style>
@stop

@section('title')
	Pago de Reserva
@stop

@section('content')
{!!Form::open(array('url' => 'salesman/event/pay_booking/store','files'=>true,'id'=>'form','method' => 'post'))!!}   
    <legend>Información del evento</legend>
    {!!Form::hidden('reserve_id',$reserve)!!}
    <div class="select Type col-md-12"> 
        <label>
            <div class="col-md-4">
                <h4 > Nombre del Evento </h4>
                {!! Form::text('event_name', $event->name, ['class' => 'form-control', 'disabled']) !!}
                {!!Form::hidden('event_id',$event->id,['id'=>'event_id'])!!}
            </div>
            <div class="col-md-4">
                <h4 class="boxy"> Función del evento </h4>
                {!! Form::text('presentation_id', date('d-m-Y',$presentation->starts_at), ['class' => 'form-control boxy', 'disabled']) !!}
                {!!Form::hidden('presentation_id',$presentation->id,['id'=>'pres_selection'])!!}
            </div>
            <div class="col-md-4"> 
                <h4 > Zona del Evento </h4>
                {!! Form::text('zone_id', $zone->name, ['class' => 'form-control', 'disabled']) !!}
                {!!Form::hidden('zone_id',$zone->id, ['id'=>'zone_id'])!!}
            </div>
            <div class="col-md-6"> 
                <h4 > Cantidad de entradas </h4>
                {!! Form::text('quantity', $tickets->quantity, ['class' => 'form-control', 'disabled','id'=>'quantity']) !!}
            </div>
            <div class="col-md-6"> 
                <h4 > Total (S/.) </h4>
                {!! Form::text('total', $tickets->total_price, ['class' => 'form-control', 'disabled']) !!}
            </div>

        </label>
    </div>
    <div class= "button-final col-md-12">
        <button type="button" id="payModal" class="btn btn-info" data-toggle="modal" data-target="#mix2" data-whatever="@mdo">Realizar Pago</button>
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
                        <div class="row form-group">
                            <div class="col-md-12 form-group checkbox pay">
                                <b>Monto a Pagar</b>
                                {!!Form::number('',null,['id'=>'total2','class'=>'form-control','readonly','placeholder'=>'S/.'])!!}
                            </div>
                            <br>
                            <div class="col-md-12 form-group checkbox pay">
                                {!!Form::radio('payMode', config('constants.credit'), null,['id'=>'creditCardPay','onChange'=>'getPromo()'])!!}
                                <b>Pago con tarjeta</b>
                                <hr>
                                <b>Número de Tarjeta</b>
                                {!!Form::number('',null,['id'=>'creditCardNumber','class'=>'form-control','placeholder'=>'1234 5678 9012 3456','disabled','min'=>1, 'max'=>9999999999999999,'required'])!!}
                                <b>Fecha de expiración</b>
                                <input type="date" id="expirationDate" class="form-control" disabled="true" min="{{date("Y-m-j")}}" required>
                                <b>Código de Seguridad</b>
                                {!!Form::number('',null,['id'=>'securityCode','class'=>'form-control','placeholder'=>'123','disabled','min'=>0,'max'=>999,'required'])!!}
                            </div>
                            <br>  
                            <div class="col-md-12 form-group checkbox pay">
                                {!!Form::radio('payMode', config('constants.cash'), null,['id'=>'cashPay','onChange'=>'getPromo()'])!!}
                                <b>Pago con efectivo</b>

                                <h5 class="text-center">Tipo de Cambio: Compra - S/. {{$exchangeRate->buyingRate}} | Venta - S/. {{$exchangeRate->sellingRate}}</h5>
                                    {!!Form::hidden('',$exchangeRate->buyingRate,['id'=>'exchangeRate'])!!}
                                <hr>
                                <div class="col-md-6">
                                    <b>Monto Ingresado en soles</b>
                                    {!!Form::number('',null,['id'=>'amountIn','class'=>'form-control','placeholder'=>'S/. ','disabled','min'=>0, 'onChange'=>'getChange()'])!!}
                                </div>
                                <div class="col-md-6">
                                    <b>Monto Ingresado en dolares</b>
                                    {!!Form::number('',null,['id'=>'amountInDollars','class'=>'form-control','placeholder'=>'$ ','disabled','min'=>0, 'onChange'=>'getChange()'])!!}
                                    
                                </div>
                                <div class="col-md-12">
                                    <b>Vuelto</b>
                                    {!!Form::text('',null,['id'=>'change','class'=>'form-control','placeholder'=>'S/. ','readonly'])!!}
                                </div>
                            </div>
                            <div class="col-md-12"><hr></div>
                            <br>  
                            <div class="col-md-12 form-group checkbox pay">
                                {!!Form::radio('payMode', config('constants.mix'), null,['id'=>'mixPay', 'onChange'=>'getPromo()'])!!}
                                <b>Pago mixto</b>
                                <hr>
                                <div class="col-md-12">
                                    <b>Cantidad a pagar en efectivo</b>
                                    {!!Form::number('paymentMix',null,['id'=>'paymentMix','class'=>'form-control','placeholder'=>'S/. ','disabled','min'=>0])!!}
                                </div>
                                <div class="col-md-6">
                                    <b>Monto Ingresado en soles</b>
                                    {!!Form::number('amountMix',null,['id'=>'amountMix','class'=>'form-control','placeholder'=>'S/. ','disabled','min'=>0,'onChange'=>'getChangeMix()'])!!}
                                </div>
                                <div class="col-md-6">
                                    <b>Monto Ingresado en dolares</b>
                                    {!!Form::number('amountMix',null,['id'=>'amountMixDollars','class'=>'form-control','placeholder'=>'S/. ','disabled','min'=>0,'onChange'=>'getChangeMix()'])!!}
                                </div>
                                <div class="col-md-12">
                                    <b>Vuelto</b>
                                    <p>{!!Form::text('',null,['id'=>'changeMix','class'=>'form-control','placeholder'=>'S/. ','readonly'])!!}</p>
                                </div>
                                <div class="col-md-12">
                                    {!!Form::submit('Pagar Entrada',array('id'=>'pay','class'=>'btn btn-info', 'disabled'))!!}
                                    <button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button>
                                </div>
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
    {!!Html::script('js/main.js')!!}
    <script type="text/javascript">
    var config = {
        routes: [
            { zone: "{{ URL::route('ajax.getClient') }}" },
            { price_ajax: "{{ URL::route('ajax.getPrice') }}" },
            { event_available: "{{URL::route('ajax.getAvailable')}}"},
            { slots: "{{URL::route('ajax.getSlots')}}"},
            { makeArray: "{{URL::route('ajax.getZone')}}"},
            { takenSlots: "{{URL::route('ajax.getTakenSlots')}}"},
            { promo: "{{URL::route('ajax.getPromo')}}"}
        ]
    };
    </script>
@stop