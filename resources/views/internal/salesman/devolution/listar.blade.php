@extends('layout.salesman')

@section('style')

@stop

@section('title')
	Devoluciones
@stop

@section('content')
<div class="contaniner">
  {!!Form::open(array('url' => 'salesman/ticket/repay','id'=>'form','class'=>'form-inline'))!!}
  <div class="row">
    <div class="col-sm-5 pull-right">
      <div class="form-group">
        <label class="sr-only" for="idTicket">ID TICKET</label>
        <div class="input-group">
          <div class="input-group-addon">TICKET</div>
          <input type="text" class="form-control" id="idTicket" placeholder="ID TICKET" required name="ticket_id">
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
      <th>Administrador</th>
      <th>Fecha</th>
      <th>Precio total</th>
      <th>Cantidad</th>
      <th>Monto Devuelto</th>

    </tr>
    @foreach($devolutions as $devolution)
    <tr>
      <td>{{$devolution->ticket_id}}</td>
      <td>{{$devolution->administrator["name"]}}</td>
      <td>{{$devolution->created_at}}</td>
      <td>s/ {{$devolution->ticket["total_price"]}}</td>
      <td>{{$devolution->ticket["quantity"]}}</td>
      <td>s/ {{$devolution->repayment}}</td>
    </tr>
    @endforeach
  </table>
@stop

@section('javascript')

@stop