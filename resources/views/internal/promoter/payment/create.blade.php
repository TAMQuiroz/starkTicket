@extends('layout.promoter')

@section('style')

@stop

@section('title')
@stop

@section('content')
<div class="row">
    <div class="col-sm-6">
        <legend>Detalles del evento :</legend>
        <p><b>Nombre</b>: {{$event->name}}</p>
        <p><b>Categoria</b>: {{$event->category["name"]}}</p>
        <p><b>Efectivo =</b> S/ {{ $event->amount_comission }}</p>
        <p><b>Porcentaje de ventas =</b> {{ $event->percentage_comission }}  % </p>
    </div>
    <div class="col-sm-6">
        <legend>Datos del organizador:</legend>
        <p><b>Nombre:</b> {{ $event->organization["organizerName"]}}</p>
        <p><b>RUC:</b> {{ $event->organization["ruc"]}}</p>
        <p><b>Cuenta:</b> {{ $event->organization["countNumber"]}}</p>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-sm-6">
        <p><b>Total recaudado =</b> S/ {{ $amountAccumulated }}</p>
        <p><b>Beneficio =</b> S/ {{ $benefit }}</p>
        <p><b>Total a pagar =</b> S/ {{ $totalToPay }}</p>
        <p><b>Pagos anteriores =</b> S/ {{ $paid }}</p>
        <p><b>Deuda =</b> S/ {{ $debt }}</p>
    </div>
<div class="col-sm-6">
        <legend>Transferir Pago</legend>
    <form class="form-horizontal" method="post" id="form">
    {!!Form::open(array('id'=>'form','class'=>'form-horizontal'))!!}
        <input name="event_id" value="{{$event->id}}" type="hidden">
        <div class="form-group">
            <label  class="col-sm-2 control-label">Fecha entrega</label>
            <div class="col-sm-10">
                {!! Form::date('dateDelivery','', array('class' => 'form-control','required')) !!}
            </div>
        </div>
        <div class="form-group">
            <label  class="col-sm-2 control-label">Monto de deuda</label>
            <div class="col-sm-10">
            <p class="form-control"  style="border:0">S/ <span id="monto_total">{{ $debt }}</span></p>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Monto a pagar</label>
            <div class="col-sm-10">
              {!! Form::text('paid','0', array('class' => 'form-control',"id"=>"monto_pagar",'required')) !!}
            </div>
        </div>
        <div class="form-group">
            <label  class="col-sm-2 control-label">Saldo</label>
            <div class="col-sm-10">
                <p class="form-control" style="border:0">s/ <span id="saldo">00</span></p>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <a class="btn btn-info" data-toggle="modal" data-target="#submitModal">Registrar pago</a>
              <a  type="reset" class="btn btn-info" href="javascript:window.history.back();">Cancelar</a>
            </div>
        </div>

      <div class="modal fade"  id="submitModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">¿Estas seguro que desea transferir pago?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">No</button>
                <button id="yes" type="submit" class="btn btn-info">Si</button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
    </form>
</div>
</div>
@stop

@section('javascript')
<script type="text/javascript">
$(document).ready(function(){
    console.log(document.referrer);
    $("#monto_pagar").change(function(){
        $("#saldo").text($("#monto_total").text() - $("#monto_pagar").val() );
    });
});
</script>
@stop