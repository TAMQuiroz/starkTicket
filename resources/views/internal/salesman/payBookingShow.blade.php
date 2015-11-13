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
{!!Form::open(array('url' => 'salesman/event/pay_booking/store','files'=>true,'id'=>'form','class'=>'form-horizontal'))!!}   
    <legend>Información del evento</legend>
    {!!Form::hidden('reserve_id',$reserve)!!}
    <div class="select Type col-md-12"> 
        <label>
            <div class="col-md-4">
                <h4 > Nombre del Evento </h4>
                {!! Form::text('event_name', $event->name, ['class' => 'form-control', 'disabled']) !!}
            </div>
            <div class="col-md-4">
                <h4 class="boxy"> Función del evento </h4>
                {!! Form::text('presentation_id', date('d-m-Y',$presentation->starts_at), ['class' => 'form-control boxy', 'disabled']) !!}
            </div>
            <div class="col-md-4"> 
                <h4 > Zona del Evento </h4>
                {!! Form::text('zone_id', $zone->name, ['class' => 'form-control', 'disabled']) !!}
            </div>
            <div class="col-md-6"> 
                <h4 > Cantidad de entradas </h4>
                {!! Form::text('quantity', $tickets->quantity, ['class' => 'form-control', 'disabled']) !!}
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
                            <div class="form-group">
                                <label>Monto a Pagar</label>
                                {!!Form::number('',$tickets->total_price,['id'=>'total2','class'=>'form-control','readonly','placeholder'=>'S/.'])!!}
                                <br>
                                <div class="form-group checkbox pay" id="modpay">
                                    <label>
                                        {!!Form::radio('payMode', config('constants.credit'), null,['id'=>'creditCardPay','onChange'=>'getPromo()'])!!}Pago con tarjeta
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
                                <div class="form-group checkbox pay" id="modpay">
                                    <label>
                                        {!!Form::radio('payMode', config('constants.cash'), null,['id'=>'cashPay','onChange'=>'getPromo()'])!!}Pago con efectivo
                                    </label>
                                    <h5>Tipo de Cambio: S/.2.90</h5>
                                    <hr>
                                    <label for="exampleInputEmail2">Monto Ingresado</label>
                                    {!!Form::number('',null,['id'=>'amountIn','class'=>'form-control','placeholder'=>'S/. ','disabled','min'=>0])!!}
                                    <label for="exampleInputEmail2">Vuelto</label>
                                    {!!Form::text('',null,['id'=>'change','class'=>'form-control','placeholder'=>'S/. ','readonly'])!!}
                                </div>
                                <br>  
                                <div class="form-group checkbox pay" id="modpay">
                                    <label>
                                        {!!Form::radio('payMode', config('constants.mix'), null,['id'=>'mixPay', 'onChange'=>'getPromo()'])!!}Pago mixto
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
    {!!Html::script('js/main.js')!!}
    <script type="text/javascript">
    var config = {
        routes: [
            { promo: "{{URL::route('ajax.getPromo')}}"}
        ]
    };
    </script>
@stop