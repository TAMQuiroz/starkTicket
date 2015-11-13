@extends('layout.salesman')

@section('style')

@stop

@section('title')
	Devoluciones
@stop

@section('content')
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