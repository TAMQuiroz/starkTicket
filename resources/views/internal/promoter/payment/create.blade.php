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
        <p><b>Presentacion(es)</b></p>
        <ul>
            @foreach ( $event->presentations as $presentation)
            <li>{{date("d/m/Y",$presentation->starts_at)}}</li>
            @endforeach
        </ul>
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
        <p><b>Total a pagar =</b> S/ {{ $fullAmount }}</p>
        <p><b>Comisión =</b> S/ {{ $paid }}</p>
        <p><b>Pagos anteriores =</b> S/ {{ $paid }}</p>
        <p><b>Deuda =</b> S/ {{ $debt }}</p>
    </div>
<div class="col-sm-6">
        <legend>Transferir Pago</legend>
    <form class="form-horizontal" method="post">
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
            <p class="form-control"  style="border:0">s/ <span class="monto_total">{{ $debt }}</span></p>
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
                <p class="form-control" style="border:0">s/ <span class="saldo">00</span></p>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button  type="submit" class="btn btn-info" href="#" >Registrar pago</button>
              <button  type="reset" class="btn btn-info">Cancelar</button>
            </div>
        </div>
    </form>
</div>
</div>
@stop

@section('javascript')
<script type="text/javascript">
$(document).ready(function(){
    $("#monto_pagar").change(function(){
        $("#saldo").val($("#monto_total").val() - $("#monto_pagar").val() );
    });
});
</script>
@stop