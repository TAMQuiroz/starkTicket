@extends('layout.salesman')

@section('style')

@stop

@section('title')
	Devoluciones de tickets
@stop

@section('content')
<div class="contaniner">
  {!!Form::open(array('url' => 'salesman/ticket/repay','id'=>'form','class'=>'form-inline'))!!}
  <div class="row">
    <div class="col-sm-5 pull-right">
      <div class="form-group">
        <label class="sr-only" for="idTicket">Código ticket</label>
        <div class="input-group">
          <div class="input-group-addon">TICKET</div>
          <input type="text" class="form-control" id="idTicket" placeholder="Código ticket" required name="ticket_id">
        </div>
      </div>
      <input type="submit" value="Verificar Ticket" class="btn btn-info">
    </div>
  </div>
</form>
</div>
<hr>
  <table class="table table-bordered table-striped">
    <tr>
      <th>Código Ticket</th>
      <th>Fecha devolución</th>
      <th>Cantidad entradas</th>
      <th>Precio total</th>
      <th>Monto Devuelto</th>
      <th>Observación</th>
    </tr>
    @foreach($devolutions as $devolution)
    <tr>
      <td>{{$devolution->ticket_id}}</td>
      <td>{{$devolution->created_at}}</td>
      <td>{{$devolution->ticket["quantity"]}}</td>
      <td>s/ {{$devolution->ticket["total_price"]}}</td>
      <td>s/ {{$devolution->repayment}}</td>
      <td>{{$devolution->observation}}</td>
    </tr>
    @endforeach
  </table>
@stop

@section('javascript')

@stop