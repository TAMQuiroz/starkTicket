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
              <input type="text" class="form-control" id="ticket_id" placeholder="" name="repayment" required>
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
              <a class="btn btn-info" data-toggle="modal" data-target="#submitModal">Guardar</a>
              <button type="reset" class="btn btn-info">Cancelar</button>
            </div>
          </div>

      <div class="modal fade"  id="submitModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">¿Estas seguro que desea devolver ticket?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">No</button>
                <button id="yes" type="submit" class="btn btn-info">Si</button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
        </form>
      @else

        <div class="alert alert-info">No esta autorizado para devolver ticket</div>
        <legend>Puntos de venta autorizados para devolver</legend>
        @if (count($authorizedModule))
          <ul>
            @foreach($authorizedModule  as $obj)
            <li>{{$obj->name}} {{$obj->address}}</li>
            @endforeach
          </ul>
        @else
        <div class="alert alert-info">No hay puntos de venta autorizados para la devoluciòn</div>
        @endif
      @endif
    </div>
</div>
@stop

@section('javascript')
@stop