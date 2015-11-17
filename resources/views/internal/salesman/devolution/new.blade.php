@extends('layout.salesman')

@section('style')

@stop

@section('title')
	Devolver ticket #{{$ticket->id}}
@stop

@section('content')
<div class="row">
    <div class="col-sm-6">
      <legend>Ticket</legend>
      <p><b>Id:</b>: {{$ticket->id}}</p>
      <p><b>Precio total:</b>: S/ {{$ticket->total_price}}</p>
      <p><b>Descuento:</b>: S/ {{$ticket->discount}}</p>
      <p><b>Cantidad:</b>: {{$ticket->quantity}}</p>
      <legend>Presentación</legend>
      <p><b>Fecha</b>: {{date('Y-m-d',$ticket->presentation["starts_at"])}}</p>
      <p><b>Evento</b>: {{$ticket->event["name"]}}</p>
      <legend>Cliente</legend>
      <p><b>Full Name</b>: {{$ticket->owner["name"]}} {{$ticket->owner["lastname"]}}</p>
      <p><b>DI </b>: {{$ticket->owner["di"]}}</p>
    </div>
    <div class="col-sm-6">
      @if($isAuthorized)
          <legend>Devolver ticket</legend>
          {!!Form::open(array('id'=>'form','class'=>'form-horizontal'))!!}
          <input type="hidden" name="ticket_id" value="{{$ticket->id}}" required>
          <div class="form-group">
            <label for="ticket_id" class="col-sm-3 control-label">Devolver s/ :</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="ticket_id" placeholder="" name="repayment">
            </div>
          </div>
          <div class="form-group">
            <label for="ticket_id" class="col-sm-3 control-label">Observaciòn:</label>
            <div class="col-sm-9">
              <textarea class="form-control" name="observation" rows="5">
              </textarea>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button class="btn btn-info">Guardar</button>
              <button type="reset" class="btn btn-info">Cancelar</button>
            </div>
          </div>
        </form>
      @else
        <legend>Modulos autorizados para devolver</legend>
          <ul>
            @foreach($authorizedModule  as $obj)
            <li>{{$obj->name}} {{$obj->address}}</li>
            @endforeach
          </ul>
      @endif
    </div>
</div>
@stop

@section('javascript')
@stop